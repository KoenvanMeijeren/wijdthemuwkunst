<?php

declare(strict_types=1);


namespace System\View;

use Src\Core\URI;
use Src\View\BaseView;

/**
 * Provides a base view for domain views.
 *
 * @package Src\View
 */
final class DomainView extends BaseView {

  /**
   * DomainView constructor.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   */
  public function __construct(string $name, array $content = []) {
    $layout = 'layout.view.php';
    if (strpos(URI::getUrl(), 'admin') !== FALSE) {
      $layout = 'admin.layout.view.php';
    }

    parent::__construct($layout, $name, $content);
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

    includeFile(DOMAIN_PATH . "/{$name}.view.php", $content);

    return (string) ob_get_clean();
  }

}
