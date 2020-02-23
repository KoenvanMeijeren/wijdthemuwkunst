<?php
declare(strict_types=1);


namespace Domain\Pages\Models;

use Src\Core\Router;
use Src\Core\URI;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

final class Page extends Model
{
    use SoftDelete;

    protected string $table = 'page';
    protected string $foreignTable = 'slug';
    protected string $primaryKey = 'page_ID';
    protected string $foreignKey = 'page_slug_ID';
    protected string $primarySlugKey = 'slug_ID';
    protected string $slugKey = 'slug_name';
    protected string $slugSoftDeletedKey = 'slug_is_deleted';
    protected string $inMenu = 'page_in_menu';
    protected string $isPublishedKey = 'page_is_published';
    protected string $softDeletedKey = 'page_is_deleted';

    public function __construct()
    {
        $this->addScope(
            (new DB)->innerJoin(
                $this->foreignTable,
                $this->primarySlugKey,
                $this->foreignKey
            )->where(
                $this->slugSoftDeletedKey,
                '=',
                '0'
            )->where(
                $this->isPublishedKey,
                '=',
                '1'
            )
        );

        $this->initializeSoftDelete();
    }

    public function getSlug(): string
    {
        return Router::getWildcard() === '' ? URI::getUrl() : Router::getWildcard();
    }

    public function getBySlug(string $slug): ?stdClass
    {
        return $this->firstByAttributes([$this->slugKey => $slug]);
    }

    public function getByVisibility(int $visibility): array
    {
        $this->addScope(
            (new DB)->where(
                $this->inMenu,
                '=',
                (string) $visibility
            )
        );

        return $this->all(['*']);
    }
}
