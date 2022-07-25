<?php
declare(strict_types=1);

namespace Modules\Cms\Structure\Controllers;

use Components\Route\RouteGet;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use JetBrains\PhpStorm\Pure;
use System\Controller\ControllerBase;

/**
 * The controller of the structure of the content management system.
 *
 * @package Modules\Cms\Structure\Controllers
 */
final class StructureController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  #[Pure] public function __construct() {
    parent::__construct('Cms/Structure/Views/');
  }

  /**
   * Returns the index page of a category with items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  #[RouteGet('admin/dashboard', rights: RouteRights::ADMIN)]
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_dashboard_title'),
      'items' => $this->indexMenu($this->currentUser()),
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
  #[RouteGet('admin/content', rights: RouteRights::ADMIN)]
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
  #[RouteGet('admin/structure', rights: RouteRights::ADMIN)]
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
  #[RouteGet('admin/configuration', rights: RouteRights::ADMIN)]
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
  #[RouteGet('admin/reports', rights: RouteRights::ADMIN)]
  public function reports(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_reports_title'),
      'items' => $this->reportsMenu(),
    ]);
  }

}
