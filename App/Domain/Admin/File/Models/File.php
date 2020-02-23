<?php
declare(strict_types=1);


namespace App\Domain\Admin\File\Models;

use Src\Model\Model;

final class File extends Model
{
    protected string $table = 'file';
    protected string $primaryKey = 'file_ID';
    protected string $pathKey = 'file_path';
    protected string $isDeleted = 'file_is_deleted';

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function getPathKey(): string
    {
        return $this->pathKey;
    }
}
