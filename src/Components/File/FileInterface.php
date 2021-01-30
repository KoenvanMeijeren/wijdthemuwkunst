<?php

namespace Components\File;


use Components\File\Exceptions\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Provides an interface for interacting with files on the file system.
 *
 * @package Components\File
 */
interface FileInterface {

  /**
   * Checks if the given path already has stored content.
   *
   * @return bool
   *   Whether the file is empty or not.
   */
  public function isEmpty(): bool;

  /**
   * Puts content in the file.
   *
   * @param string $content
   *   The content of the file.
   */
  public function putContent(string $content): void;

  /**
   * Determines if the file exists.
   *
   * @return bool
   *   If the file exists.
   */
  public function exists(): bool;

  /**
   * Gets the content of the file.
   *
   * @param string[] $variables
   *   The variables of the file.
   *
   * @return string
   *   The file.
   *
   * @throws FileNotFoundException
   */
  public function get(array $variables = []): string;

  /**
   * Gets the file system.
   *
   * @return Filesystem
   *   The loaded file system.
   */
  public function getFilesystem(): Filesystem;

}
