<?php
declare(strict_types=1);

namespace Src\View;

use Components\SuperGlobals\Url\Uri;

/**
 * Provides a class for normal views.
 *
 * @package src\View
 */
final class View extends BaseView {

  /**
   * {@inheritDoc}
   */
  public function __construct(string $name, array $content = []) {
    $layout = 'layout.view.php';
    if (str_contains(Uri::getUrl(), 'admin')) {
      $layout = 'admin.layout.view.php';
    }

    parent::__construct($layout, $name, $content);
  }

  /**
   * {@inheritDoc}
   */
  protected function renderContent(string $name, array $content = []): string {
    ob_start();

    include_file(RESOURCES_PATH . "/partials/{$name}.view.php", $content);

    return (string) ob_get_clean();
  }

}
