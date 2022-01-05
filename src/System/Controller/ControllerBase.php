<?php
declare(strict_types=1);

namespace System\Controller;

use Components\ComponentsTrait;
use Components\View\ViewInterface;
use Modules\Cms\Structure\MenuAdminTrait;
use System\View\DomainView;

/**
 * Provides a controller base for controllers.
 *
 * @package System\Controller
 */
abstract class ControllerBase implements ControllerInterface {

  use ComponentsTrait;
  use MenuAdminTrait;

  /**
   * ControllerBase constructor.
   *
   * @param string $baseViewPath
   *   The base path to the view directory.
   */
  public function __construct(
    protected readonly string $baseViewPath = ''
  ) {}

  /**
   * Returns a domain view.
   *
   * @param string $name
   *   The name of the domain view.
   * @param array $content
   *   The content of the domain view.
   *
   * @return \Components\View\ViewInterface
   *   The renderable domain view.
   */
  protected function view(string $name, array $content = []): ViewInterface {
    return new DomainView($this->baseViewPath . $name, $content);
  }

}
