<?php
declare(strict_types=1);


namespace Domain\Admin\File\Actions;

use Cake\Chronos\Chronos;
use Src\Action\FileAction;
use Src\Core\Request;
use Src\Core\Upload;
use Support\DateTime;

final class UploadBannerAction extends FileAction
{
    public function __construct()
    {
        $request = new Request();

        $this->acceptedOrigins[] = $request->env('app_uri');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): void
    {
        $request = new Request();

        $file = $request->file('bannerOutput');

        if (array_key_exists('name', $file)) {
            $datetime = new Chronos();
            $file['name'] .= $datetime->toDateTimeString();
        }

        $uploader = new Upload($file);

        if (count($file) > 0
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