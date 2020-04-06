<?php
declare(strict_types=1);


namespace Domain\Admin\File\Controllers;

use Domain\Admin\File\Actions\UploadFileAction;
use Domain\Admin\File\Actions\UploadImageAction;

final class UploadFileController
{
    public function store(): void
    {
        $upload = new UploadFileAction();

        $upload->execute();
    }

    public function thumbnail(): void
    {
        $upload = new UploadImageAction('thumbnailOutput');
        $upload->execute();
    }

    public function banner(): void
    {
        $upload = new UploadImageAction('bannerOutput');
        $upload->execute();
    }
}
