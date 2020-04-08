<?php
declare(strict_types=1);


namespace Domain\Admin\File\Actions;

use Cake\Chronos\Chronos;
use Src\Action\FileAction;
use Src\Core\Request;
use Src\Core\Upload;

final class UploadImageAction extends FileAction
{
    private array $file;

    public function __construct(string $fileName)
    {
        $request = new Request();

        $this->file = $request->file($fileName);

        $uri = $request->env('app_uri');
        $shortUri = replaceString('www.', '', $uri);

        $this->acceptedOrigins[] = $uri;
        $this->acceptedOrigins[] = $shortUri;
    }

    /**
     * @inheritDoc
     */
    protected function handle(): void
    {
        if (array_key_exists('name', $this->file)) {
            $datetime = new Chronos();
            $this->file['name'] .= $datetime->toDateTimeString();
        }

        $uploader = new Upload($this->file);

        if (count($this->file) > 0
            && $uploader->prepare()
            && $uploader->getFileIfItExists() === ''
        ) {
            $uploader->execute();
        }

        echo json_encode(
            array('location' => $uploader->getFileIfItExists()),
            JSON_THROW_ON_ERROR,
            512
        );
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        $request = new Request();

        if (!in_array(
            $request->server(Request::HTTP_ORIGIN),
            $this->acceptedOrigins,
            true
        )
        ) {
            header('HTTP/1.1 403 Origin Denied');

            return false;
        }

        header(
            'Access-Control-Allow-Origin: ' .
            $request->server(Request::HTTP_ORIGIN)
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
