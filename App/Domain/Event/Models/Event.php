<?php


namespace App\Domain\Event\Models;


use Src\Core\Router;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

class Event extends Model
{
    use SoftDelete;

    protected string $table = 'event';
    protected string $primaryKey = 'event_ID';
    protected string $isPublishedKey = 'event_is_published';
    protected string $softDeletedKey = 'event_is_deleted';

    public function __construct()
    {
        $this->addScope(
            (new DB)->where(
                $this->isPublishedKey,
                '=',
                '1'
            )
        );

        $this->initializeSoftDelete();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    public function getLimited(int $limit): array
    {
        $this->addScope(
            (new DB)->limit($limit)
        );

        return $this->all(['*']);
    }
}
