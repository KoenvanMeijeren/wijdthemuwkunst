<?php
declare(strict_types=1);

namespace Src\Action;

use Src\Core\Request;
use Src\Core\Upload;

/**
 * Provides a base class for file actions.
 *
 * @package src\Action
 */
abstract class FileAction extends Action {

  /**
   * The request definition.
   *
   * @var \Src\Core\Request
   */
  protected Request $request;

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
   * @var string
   */
  protected string $fileLocation;

  /**
   * File action constructor.
   */
  public function __construct() {
    $this->request = new Request();

    $uri = $this->request->env('app_uri');
    $shortUri = replace_string('www.', '', $uri);

    $this->acceptedOrigins[] = $uri;
    $this->acceptedOrigins[] = $shortUri;

    $this->origin = $this->request->server(Request::HTTP_ORIGIN);
  }

  /**
   * Gets the uploaded file.
   *
   * @return array
   *   The file.
   */
  abstract protected function getFile(): array;

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    if (count($this->getFile()) === 0) {
      return FALSE;
    }

    $uploader = new Upload($this->getFile());
    if ($uploader->prepare() && $uploader->getFileIfItExists() === '') {
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
      header('HTTP/1.1 403 Origin Denied');

      return FALSE;
    }

    header('Access-Control-Allow-Origin: ' . $this->origin);

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
