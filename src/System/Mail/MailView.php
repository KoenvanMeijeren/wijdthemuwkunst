<?php
declare(strict_types=1);

namespace System\Mail;

use Components\File\File;

/**
 * Provides a class for mail views.
 *
 * @package System\View
 */
final class MailView extends BaseMailView {

  /**
   * {@inheritDoc}
   */
  protected function render(string $name, array $content = []): string {
    $file = new File(directory: '', file: "{$name}.view.php");

    return $file->get($content);
  }

}
