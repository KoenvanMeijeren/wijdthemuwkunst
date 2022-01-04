<?php
declare(strict_types=1);

namespace Modules\Setting\Controllers;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Setting\Actions\CreateSettingAction;
use Modules\Setting\Actions\DeleteSettingAction;
use Modules\Setting\Actions\UpdateSettingAction;
use Modules\Setting\Entity\Setting;
use Modules\Setting\Entity\SettingTable;
use System\Entity\EntityControllerBase;
use System\State;

/**
 * Provides a controller for maintaining the settings.
 *
 * @package Modules\Setting\Controllers
 */
final class SettingsControllers extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/configuration/settings';

  /**
   * SettingsControllers constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Setting::class, baseViewPath: 'Setting/Views/');
  }

  /**
   * Returns all settings.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function index(): ViewInterface {
    $settingTable = new SettingTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('settings_title'),
      'settings' => $settingTable->get(),
    ]);
  }

  /**
   * Returns the view for creating settings.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function create(): ViewInterface {
    $settingTable = new SettingTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('settings_title'),
      'settings' => $settingTable->get(),
      'createSetting' => TRUE,
    ]);
  }

  /**
   * Stores the setting in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function store(): ViewInterface|Redirect {
    $create = new CreateSettingAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   * Returns an edit view for settings.
   *
   * @return \Components\Header\Redirect|ViewInterface
   *   The view.
   */
  public function edit(): ViewInterface|Redirect {
    $settingTable = new SettingTable($this->repository->all());
    $setting = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if ($setting === NULL) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('setting_does_not_exists'));

      return new Redirect('/admin/configuration/settings');
    }

    return $this->view('index', [
      'title' => TranslationOld::get('settings_title'),
      'settings' => $settingTable->get(),
      'setting' => $setting,
    ]);
  }

  /**
   * Updates the setting in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function update(): ViewInterface|Redirect {
    $update = new UpdateSettingAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   * Destroys a setting in the database.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  public function destroy(): Redirect {
    $destroy = new DeleteSettingAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}
