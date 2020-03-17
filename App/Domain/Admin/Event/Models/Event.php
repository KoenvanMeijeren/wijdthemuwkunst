<?php


namespace App\Domain\Admin\Event\Models;

use Src\Core\Router;
use Src\Core\URI;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

final class Event extends Model
{
    use SoftDelete;

    protected string $table = 'event';
    protected string $foreignTable = 'slug';
    protected string $primaryKey = 'event_ID';
    protected string $foreignKey = 'event_slug_ID';
    protected string $primarySlugKey = 'slug_ID';
    protected string $datetimeKey = 'event_date';
    protected string $archivedKey = 'event_is_archived';
    protected string $softDeletedKey = 'event_is_deleted';
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

    /**
     * Get all events.
     *
     * @return object[]
     */
    public function getAll(): array
    {
        $this->addScope(
            (new DB)->where(
                $this->archivedKey,
                '=',
                '0'
            )->orderBy('asc', $this->datetimeKey)
        );

        return $this->all();
    }

    /**
     * Get all archived events.
     *
     * @return object[]
     */
    public function getAllArchived(): array
    {
        if (array_key_exists('event_is_archived', $this->scopes['values'])) {
            $this->scopes['values']['event_is_archived'] = '1';
        }

        $this->addScope(
            (new DB)->where(
                $this->archivedKey,
                '=',
                '1'
            )->orderBy('asc', $this->datetimeKey)
        );

        return $this->all();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    public function getSlug(): string
    {
        $slug = Router::getWildcard();
        if ($slug === '') {
            $slug = URI::getUrl();
        }

        return $slug;
    }

    public function getBySlug(string $slug): ?stdClass
    {
        return $this->firstByAttributes([
            $this->slugKey => $slug
        ]);
    }
}
