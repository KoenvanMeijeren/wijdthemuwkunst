<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Models;

use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

final class Slug extends Model
{
    use SoftDelete;

    protected string $table = 'slug';
    protected string $primaryKey = 'slug_ID';
    protected string $softDeletedKey = 'slug_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    public function parse(string $slug): string
    {
        return encodeUrl($slug);
    }
}
