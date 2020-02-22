<?php
declare(strict_types=1);


namespace App\Domain\Admin\File\Models;


final class File
{
    protected string $table = 'file';
    protected string $primaryKey = 'file_ID';
    protected string $path = 'file_path';
    protected string $isDeleted = 'file_is_deleted';

    private string $stored_path;

    public function __construct(string $path)
    {
        $this->stored_path = $path;
    }

    public function exists(): bool
    {
        return file_exists($this->stored_path);
    }
}
