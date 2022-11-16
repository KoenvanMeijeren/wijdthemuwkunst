<?php

namespace Components\File;


use Components\File\Exceptions\ErrorWhileUploadingFileException;

/**
 * Provides an interface for uploading files.
 *
 * @package Components\Fil
 */
interface UploadInterface {

  /**
   * The various allowed file options.
   *
   * @var string[]
   */
  public const ALLOWED_FILE_TYPES = [
    'image/jpg' => 'jpg',
    'image/jpeg' => 'jpeg',
    'image/svg+xml' => 'svg',
    'image/png' => 'png',
  ];

  /**
   * The maximum size of the file.
   *
   * @var string
   */
  public const MAX_FILE_SIZE = '8M';

  /**
   * Prepares the file for storing on the file system.
   *
   * @return bool
   *   Whether the preparation was successful or not.
   */
  public function prepare(): bool;

  /**
   * Gets the file if it exists.
   *
   * @return string|null
   *   The file location or null.
   */
  public function getFileIfItExists(): ?string;

  /**
   * Executes the upload of the file.
   *
   * @return bool
   *   The whether the upload has been executed successfully or not.
   *
   * @throws ErrorWhileUploadingFileException
   *   When there occurs an error while uploading the file.
   */
  public function execute(): bool;

  /**
   * Gets the path to the stored file.
   *
   * @return string
   *   The path to the stored file.
   */
  public function getStoredFilePath(): string;

}
