<?php
declare(strict_types=1);


namespace App\Domain\Admin\File\Actions;

use App\Domain\Admin\File\Models\File;
use Src\Action\Action;

final class SaveFileAction extends Action
{
    private int $fileId = 0;
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $file = new File();

        $createdFile = $file->firstOrCreate([
            $file->getPathKey() => $this->path,
        ]);

        if ($createdFile !== null) {
            $this->fileId = (int) $createdFile->{$file->getPrimaryKey()};

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
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
