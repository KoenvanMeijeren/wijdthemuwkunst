<?php

declare(strict_types=1);

namespace App\System\Controller;

use App\Domain\Admin\Cms\Structure\MenuTrait;
use Src\View\ViewInterface;

/**
 * Provides a controller base for the admin controllers.
 *
 * @package App\System\Controller
 */
abstract class AdminControllerBase extends ControllerBase {
  use MenuTrait;

  /**
   * Provides an array with sub menu items for the base menu items in sidebar.
   *
   * @var mixed[]
   */
  protected array $menuItems = [];

  /**
   * AdminControllerBase constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->menuItems['menuItems'] = [
      'content' => $this->contentMenu(),
      'structure' => $this->structureMenu(),
      'configuration' => $this->configurationMenu(),
      'reports' => $this->reportsMenu(),
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function view(string $name, array $content = []): ViewInterface {
    $content = array_merge($content, $this->menuItems);

    return parent::view($name, $content);
  }

}
