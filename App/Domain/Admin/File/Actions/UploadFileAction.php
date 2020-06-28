<?php

declare(strict_types=1);


namespace Domain\Admin\File\Actions;

use Src\Action\FileAction;
use Src\Core\Request;
use Src\Core\Upload;

/**
 *
 */
final class UploadFileAction extends FileAction {

  /**
   *
   */
  public function __construct() {
    $request = new Request();

    $uri = $request->env('app_uri');
    $shortUri = replace_string('www.', '', $uri);

    $this->acceptedOrigins[] = $uri;
    $this->acceptedOrigins[] = $shortUri;
  }

  /**
   * @inheritDoc
   */
  protected function handle(): void {
    reset($_FILES);
    $temp = current($_FILES);

    $uploader = new Upload($temp);

    if (sizeof($temp) > 0
          && $uploader->prepare()
          && $uploader->getFileIfItExists() === ''
      ) {
      $uploader->execute();
    }

    echo json_encode(
          ['location' => $uploader->getFileIfItExists()],
          JSON_THROW_ON_ERROR,
          512
      );
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    $request = new Request();

    if (!in_array(
          $request->server(Request::HTTP_ORIGIN),
          $this->acceptedOrigins,
          TRUE
      )
      ) {
      header('HTTP/1.1 403 Origin Denied');

      return FALSE;
    }

    header(
          'Access-Control-Allow-Origin: ' .
          $request->server(Request::HTTP_ORIGIN)
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
