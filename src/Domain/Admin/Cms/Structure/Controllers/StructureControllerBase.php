<?php

declare(strict_types=1);

namespace Domain\Admin\Cms\Structure\Controllers;

use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 * The controller of the structure of the content managent system.
 *
 * @package Domain\Admin\Cms\Structure\Controllers
 */
final class StructureControllerBase extends AdminControllerBase {

  /**
   * {@inheritdoc}
   */
  protected string $baseViewPath = 'Admin/Cms/Structure/Views/';

  /**
   * Returns the index page of a category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_dashboard_title'),
      'items' => $this->indexMenu($this->getCurrentUser()),
    ]);
  }

  /**
   * Returns the index page of the content category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function content(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_content_title'),
      'items' => $this->contentMenu(),
    ]);
  }

  /**
   * Returns the index page of the structure category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function structure(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_structure_title'),
      'items' => $this->structureMenu(),
    ]);
  }

  /**
   * Returns the index page of the configuration category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function configuration(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_configuration_title'),
      'items' => $this->configurationMenu(),
    ]);
  }

  /**
   * Returns the index page of the reports category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function reports(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_reports_title'),
      'items' => $this->reportsMenu(),
    ]);
  }

}
