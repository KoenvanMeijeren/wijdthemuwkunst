<?php


namespace App\Domain\Admin\Menu\Models;


use Src\Core\Router;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

final class Menu extends Model
{
    use SoftDelete;

    protected string $table = 'menu';
    protected string $foreignTable = 'slug';
    protected string $primaryKey = 'menu_ID';
    public string $foreignKey = 'menu_slug_ID';
    public string $titleKey = 'menu_title';
    public string $weightKey = 'menu_weight';
    protected string $softDeletedKey = 'menu_is_deleted';

    protected string $primarySlugKey = 'slug_ID';
    protected string $slugKey = 'slug_name';
    protected string $slugSoftDeletedKey = 'slug_is_deleted';

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
            )
        );

        $this->initializeSoftDelete();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    /**
     * @return object[]
     */
    public function getAll(): array
    {
        $this->addScope((new DB)->orderBy('asc', $this->weightKey));

        return $this->all();
    }
}
