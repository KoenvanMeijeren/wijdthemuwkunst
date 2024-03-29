<?php
declare(strict_types=1);

namespace System\Mail;

use Components\ComponentsTrait;
use Components\File\Exceptions\FileNotFoundException;
use Components\File\File;

/**
 * Provides a class for mail views.
 *
 * @package System\View
 */
final class MailView extends BaseMailView {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function render(string $directory, string $name, array $content = []): string {
    try {
      $file = new File(directory: DOMAIN_PATH . '/' . $directory, file: "{$name}.view.php");

      return $file->getContent($content);
    } catch (FileNotFoundException $exception) {
      $this->log()->error($exception->getMessage());
      $file = new File(directory: MODULE_PATH . '/' . $directory, file: "{$name}.view.php");

      return $file->getContent($content);
    }
  }

}
