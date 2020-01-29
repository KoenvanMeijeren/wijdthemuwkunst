<?php
declare(strict_types=1);


namespace Domain\Admin\File\Controllers;

use Domain\Admin\File\Actions\UploadFileAction;

final class UploadFileController
{
    public function store(): void
    {
        $upload = new UploadFileAction();

        $upload->execute();
    }
}
