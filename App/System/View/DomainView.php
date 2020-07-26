<?php

declare(strict_types=1);


namespace System\View;

use Domain\Admin\Menu\Models\Menu;
use Src\Core\URI;
use Src\View\BaseView;

/**
 * Provides a base view for domain views.
 *
 * @package Src\View
 */
final class DomainView extends BaseView {

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
    $this->isAdminView = strpos(URI::getUrl(), 'admin') !== false;

    $layout = $this->isAdminView ? 'admin.layout.view.php' : 'layout.view.php';
    $content = array_merge($content, $this->globalContent());

    parent::__construct($layout, $name, $content);
  }

  /**
   * Provides global content for domain views.
   *
   * @return array
   *   The global content.
   */
  protected function globalContent(): array {
    $menu = new Menu();

    return [
      'menuItems' => $menu->getAll(),
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
