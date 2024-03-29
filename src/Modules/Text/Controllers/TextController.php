<?php

namespace Modules\Text\Controllers;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Text\Actions\CreateTextAction;
use Modules\Text\Actions\DeleteTextAction;
use Modules\Text\Actions\UpdateTextAction;
use Modules\Text\Entity\Text;
use Modules\Text\Entity\TextTable;
use System\Entity\EntityControllerBase;
use System\State;

/**
 * Provides a controller for maintaining the texts.
 *
 * @package Domain\Admin\Text\Controllers
 */
final class TextController extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/configuration/texts';

  /**
   * TextController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Text::class, baseViewPath: 'Text/Views/');
  }

  /**
   * Returns all texts.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet('admin/configuration/texts', rights: RouteRights::ADMIN)]
  public function index(): ViewInterface {
    $textTable = new TextTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('texts_title'),
      'texts' => $textTable->get(),
    ]);
  }

  /**
   * Returns the view for creating texts.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet('admin/configuration/texts/text/create', rights: RouteRights::ADMIN)]
  public function create(): ViewInterface {
    $textTable = new TextTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('texts_title'),
      'texts' => $textTable->get(),
      'createText' => TRUE,
    ]);
  }

  /**
   * Stores the text in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  #[RoutePost('admin/configuration/texts/text/create/store', rights: RouteRights::ADMIN)]
  public function store(): ViewInterface|Redirect {
    $create = new CreateTextAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   * Returns an edit view for texts.
   *
   * @return \Components\Header\Redirect|ViewInterface
   *   The view.
   */
  #[RouteGet('admin/configuration/texts/text/edit/{slug}', rights: RouteRights::ADMIN)]
  public function edit(): ViewInterface|Redirect {
    $textTable = new TextTable($this->repository->all());
    $text = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if ($text === NULL) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('text_does_not_exists'));

      return new Redirect('/admin/configuration/texts');
    }

    return $this->view('index', [
      'title' => TranslationOld::get('texts_title'),
      'texts' => $textTable->get(),
      'text' => $text,
    ]);
  }

  /**
   * Updates the text in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  #[RoutePost('admin/configuration/texts/text/edit/{slug}/update', rights: RouteRights::ADMIN)]
  public function update(): ViewInterface|Redirect {
    $update = new UpdateTextAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   * Destroys a text in the database.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  #[RoutePost('admin/configuration/texts/text/delete/{slug}', rights: RouteRights::ADMIN)]
  public function destroy(): Redirect {
    $destroy = new DeleteTextAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}
