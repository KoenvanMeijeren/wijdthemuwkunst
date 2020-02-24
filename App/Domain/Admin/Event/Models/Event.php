<?php


namespace App\Domain\Admin\Event\Models;


use Src\Core\Router;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

final class Event extends Model
{
    use SoftDelete;

    protected string $table = 'event';
    protected string $primaryKey = 'event_ID';
    protected string $softDeletedKey = 'event_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }
}
