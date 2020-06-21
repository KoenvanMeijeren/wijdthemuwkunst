<?php

declare(strict_types=1);


namespace System\View;

/**
 * Provides a class for mail views.
 *
 * @package System\View
 */
final class MailView extends BaseMailView {

  /**
   * Render a partial view into the layout view.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   *
   * @return string
   *   The renderable mail view.
   */
  protected function render(string $name, array $content = []): string {
    ob_start();

    includeFile("{$name}.view.php", $content);

    return (string) ob_get_clean();
  }

}
