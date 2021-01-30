<?php

declare(strict_types=1);


namespace System;

use Components\ComponentsTrait;
use Exception;
use Sirius\Upload\Handler as UploadHandler;
use Components\File\Exceptions\ErrorWhileUploadingFileException;
use Components\Translation\TranslationOld;

/**
 * Provides a class for uploading files.
 *
 * @package src\Core
 */
final class Upload {

  use ComponentsTrait;

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
   * The file.
   *
   * @var string[]
   */
  protected array $file;

  /**
   * The path to the file on the server.
   *
   * @var string
   */
  protected string $path;

  /**
   * The striped path of the file.
   *
   * @var string
   */
  protected string $stripedPath;

  /**
   * The path of the file on the file system.
   *
   * @var string
   */
  protected string $storedPath;

  /**
   * Prepare the file.
   *
   * @param string[] $file
   *   the file to be uploaded.
   * @param string $path
   *   the path to store the file in.
   * @param string $stripedPath
   *   the striped path to store the file in.
   */
  public function __construct(array $file, string $path = PUBLIC_PATH . '/storage/media/', string $stripedPath = '/storage/media/') {
    $this->file = $file;
    $this->path = $path;
    $this->stripedPath = $stripedPath;
  }

  /**
   *
   */
  public function prepare(): bool {
    return $this->convertFileName();
  }

  /**
   *
   */
  public function getFileIfItExists(): string {
    $documentRoot = $this->request()->server(Request::DOCUMENT_ROOT);
    $fileLocation = $this->stripedPath . $this->file['name'];
    $file = $documentRoot . $fileLocation;

    return file_exists($file) ? $fileLocation : '';
  }

  /**
   *
   */
  public function execute(): bool {
    $uploadHandler = new UploadHandler($this->path);

    $uploadHandler->addRule(
          'extension',
          ['allowed' => ['jpg', 'jpeg', 'png', 'svg']],
          '{label} should be a valid image (jpg, jpeg, png, svg)',
          'Profile picture'
      );
    $uploadHandler->addRule(
          'size',
          ['max' => '8M'],
          '{label} should have less than {max}',
          'Profile picture'
      );

    $result = $uploadHandler->process($this->file);
    if ($result->isValid()) {
      try {
        $result->confirm();
        $filename = array_key_exists('name', $result->file ?? [])
                    ? $result->file['name'] : '';
        $this->setStoredFilePath($this->stripedPath . $filename);

        return TRUE;
      }
      catch (Exception $exception) {
        $result->clear();

        $this->log()->error($exception->getMessage());
        throw new ErrorWhileUploadingFileException($exception);
      }
    }

    $this->session()->flash(
          StateInterface::FAILED,
          TranslationOld::get('error_while_uploading_file')
      );
    return FALSE;
  }

  /**
   *
   */
  public function getStoredFilePath(): string {
    return $this->storedPath;
  }

  /**
   *
   */
  private function convertFileName(): bool {
    $randomBytes = bin2hex($this->file['name']);

    $type = array_key_exists('type', $this->file) &&
            array_key_exists('name', $this->file) ?
            $this->file['type'] : '';

    if (!array_key_exists($type, self::ALLOWED_FILE_TYPES)) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('not_allowed_file_upload')
        );
      return FALSE;
    }

    $this->file['name'] = $randomBytes . '.' . self::ALLOWED_FILE_TYPES[$type];
    return TRUE;
  }

  /**
   *
   */
  private function setStoredFilePath(string $path): void {
    $this->storedPath = $path;
  }

}
