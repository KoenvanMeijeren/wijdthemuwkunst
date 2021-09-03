<?php

declare(strict_types=1);

namespace Modules\Cms\Structure\Controllers;

use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use JetBrains\PhpStorm\Pure;
use System\Controller\ControllerBase;

/**
 * The controller of the structure of the content management system.
 *
 * @package Modules\Cms\Structure\Controllers
 */
final class StructureControllerBase extends ControllerBase {

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
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_dashboard_title'),
      'items' => $this->indexMenu($this->user()),
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
