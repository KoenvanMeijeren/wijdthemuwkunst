<?php
declare(strict_types=1);

namespace Components\File;

use Components\ComponentsTrait;
use Components\File\Exceptions\ErrorWhileUploadingFileException;
use Components\SuperGlobals\RequestInterface;
use Components\Translation\TranslationOld;
use Exception;
use Sirius\Upload\Handler as UploadHandler;
use System\State;

/**
 * Provides a class for uploading files.
 *
 * @package Components\Fil
 */
final class Upload implements UploadInterface {

  use ComponentsTrait;

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
   *   The file to be uploaded.
   * @param string $path
   *   The path to store the file in.
   * @param string $stripedPath
   *   The striped path to store the file in.
   */
  public function __construct(
    protected array $file,
    protected string $path = PUBLIC_PATH . '/storage/media/',
    protected string $stripedPath = '/storage/media/'
  ) {}

  /**
   * {@inheritDoc}
   */
  public function prepare(): bool {
    return $this->convertFileName() && empty($this->getFileIfItExists());
  }

  /**
   * {@inheritDoc}
   */
  public function getFileIfItExists(): ?string {
    $documentRoot = $this->request()->server(RequestInterface::DOCUMENT_ROOT);
    $fileLocation = $this->stripedPath . $this->file['name'];
    $file = $documentRoot . $fileLocation;

    return file_exists($file) ? $fileLocation : null;
  }

  /**
   * {@inheritDoc}
   */
  public function execute(): bool {
    $uploadHandler = new UploadHandler($this->path);
    $uploadHandler->addRule('extension', ['allowed' => array_values(self::ALLOWED_FILE_TYPES)], '{label} should be a valid image (jpg, jpeg, png, svg)', 'File');
    $uploadHandler->addRule('size', ['max' => self::MAX_FILE_SIZE], '{label} should have less than {max}', 'File');

    $result = $uploadHandler->process($this->file);
    if ($result->isValid()) {
      try {
        $result->confirm();
        $filename = $result->file['name'] ?? '';
        $this->setStoredFilePath($this->stripedPath . $filename);

        return TRUE;
      }
      catch (Exception $exception) {
        $result->clear();
        $this->log()->error($exception->getMessage());

        throw new ErrorWhileUploadingFileException($exception);
      }
    }

    $this->session()->flash(State::FAILED->value, TranslationOld::get('error_while_uploading_file'));

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  public function getStoredFilePath(): string {
    return $this->storedPath;
  }

  /**
   * Converts the file name.
   *
   * @return bool
   *   Whether the file name could be converted or not.
   */
  protected function convertFileName(): bool {
    $randomBytes = bin2hex($this->file['name']);

    $type = isset($this->file['type'], $this->file['name']) ? $this->file['type'] : '';
    if (!isset(self::ALLOWED_FILE_TYPES[$type])) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('not_allowed_file_upload'));
      return FALSE;
    }

    $this->file['name'] = $randomBytes . '.' . self::ALLOWED_FILE_TYPES[$type];

    return TRUE;
  }

  /**
   * Sets the path of the stored file.
   *
   * @param string $path
   *   The path of the file.
   */
  protected function setStoredFilePath(string $path): void {
    $this->storedPath = $path;
  }

}
