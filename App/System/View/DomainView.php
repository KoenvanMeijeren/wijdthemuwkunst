<?php

declare(strict_types=1);


namespace System\View;

use Domain\Admin\Cms\Structure\MenuAdminTrait;
use Domain\Admin\Menu\Models\Menu;
use JetBrains\PhpStorm\ArrayShape;
use Src\Core\URI;
use Src\View\BaseView;

/**
 * Provides a base view for domain views.
 *
 * @package Src\View
 */
final class DomainView extends BaseView {

  use MenuAdminTrait;

  /**
   * Determines if the current view must be displayed for admins.
   *
   * @var bool
   */
  protected bool $isAdminView = false;

  /**
   * DomainView constructor.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   */
  public function __construct(string $name, array $content = []) {
    $this->isAdminView = str_contains(URI::getUrl(), 'admin');

    $layout = $this->isAdminView ? 'admin.layout.view.php' : 'layout.view.php';
    $globalContent = $this->isAdminView ? $this->globalAdminContent() : $this->globalContent();
    $content = array_merge($content, $globalContent);

    parent::__construct($layout, $name, $content);
  }

  /**
   * Provides global content for domain views.
   *
   * @return array
   *   The global content.
   */
  #[ArrayShape(['menuItems' => "object[]"])]
  protected function globalContent(): array {
    $menu = new Menu();

    return [
      'menuItems' => $menu->getAll(),
    ];
  }

  /**
   * Provides global content for domain views for admins.
   *
   * @return array
   *   The global content.
   */
  #[ArrayShape(['menuItems' => "array"])]
  protected function globalAdminContent(): array {
    return [
      'menuItems' => [
        'content' => $this->contentMenu(),
        'structure' => $this->structureMenu(),
        'configuration' => $this->configurationMenu(),
        'reports' => $this->reportsMenu(),
      ],
    ];
  }

  /**
   * Renders a partial view into the layout view.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   *
   * @return string
   *   The renderable content.
   */
  protected function renderContent(string $name, array $content = []): string {
    ob_start();

    include_file(DOMAIN_PATH . "/{$name}.view.php", $content);

    return (string) ob_get_clean();
  }

}
