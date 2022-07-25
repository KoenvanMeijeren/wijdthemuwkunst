<?php
declare(strict_types=1);

namespace Components\Actions;

use Components\File\Upload;
use Components\SuperGlobals\ServerOptions;

/**
 * Provides a base class for file actions.
 *
 * @package Components\Actions
 */
abstract class FileAction extends Action {

  /**
   * The accepted origins to uploaded files from.
   *
   * @var string[]
   */
  protected array $acceptedOrigins = [
    'http://localhost',
  ];

  /**
   * The application host origin.
   *
   * @var string
   */
  private string $origin;

  /**
   * Gets the location of the uploaded file.
   *
   * @var string|null
   */
  protected ?string $fileLocation;

  /**
   * File action constructor.
   */
  public function __construct() {
    $uri = $this->request()->env('app_uri');
    $shortUri = replace_string('www.', '', $uri);

    $this->acceptedOrigins[] = $uri;
    $this->acceptedOrigins[] = $shortUri;

    $this->origin = $this->request()->server->get(ServerOptions::HTTP_ORIGIN);
  }

  /**
   * Gets the uploaded file.
   *
   * @return string[]
   *   The file.
   */
  protected function getFile(): array {
    reset($_FILES);

    return current($_FILES);
  }

  /**
   * Gets the file upload output.
   *
   * @return string
   *   The file upload output.
   */
  abstract public function getOutput(): string;

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    if (count($this->getFile()) === 0) {
      return FALSE;
    }

    $uploader = new Upload($this->getFile());
    if ($uploader->prepare() && $uploader->getFileIfItExists() === null) {
      $uploader->execute();
    }

    $this->fileLocation = $uploader->getFileIfItExists();

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if (!in_array($this->origin, $this->acceptedOrigins, TRUE)) {
      $this->header()->accessDenied();
    }

    $this->header()->allowOrigin($this->origin);

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
