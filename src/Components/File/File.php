<?php
declare(strict_types=1);

namespace Components\File;

use Components\File\Exceptions\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Provides a class for interacting with files on the file system.
 *
 * @package Components\File
 */
final class File implements FileInterface {

  /**
   * The file system definition.
   *
   * @var Filesystem
   */
  protected Filesystem $system;

  /**
   * The path of the file.
   *
   * @var string
   */
  protected string $path;

  /**
   * File constructor.
   *
   * @param string $directory
   *   The directory of the file.
   * @param string $file
   *   The file.
   */
  public function __construct(
    protected string $directory,
    protected string $file
  ) {
    $this->system = new FileSystem();
    $this->system->mkdir($directory);
    $this->path = $this->makePath();
  }

  /**
   * {@inheritDoc}
   */
  public function isEmpty(): bool {
    $content = (string) file_get_contents(
      (string) $this->system->readlink($this->path, TRUE)
    );

    return $content === '';
  }

  /**
   * {@inheritDoc}
   */
  public function putContent(string $content): void {
    $this->system->dumpFile($this->path, $content);
  }

  /**
   * {@inheritDoc}
   */
  public function exists(): bool {
    return $this->system->readlink($this->path, TRUE) !== null;
  }

  /**
   * {@inheritDoc}
   */
  public function getContent(array $variables = []): string {
    $file = $this->system->readlink($this->path, TRUE);
    if (!$file) {
      throw new FileNotFoundException($this->path);
    }

    ob_start();

    include_file($file, $variables);

    return (string) ob_get_clean();
  }

  /**
   * {@inheritDoc}
   */
  public function get(array $variables = []): mixed {
    $file = $this->system->readlink($this->path, TRUE);
    if (!$file) {
      throw new FileNotFoundException($this->path);
    }

    return include_file($file, $variables);
  }

  /**
   * {@inheritDoc}
   */
  public function getFilesystem(): Filesystem {
    return $this->system;
  }

  /**
   * Combines the directory path and file path to one path.
   *
   * @return string
   *   The path of the file.
   */
  protected function makePath(): string {
    return $this->directory . '/' . $this->file;
  }

}
