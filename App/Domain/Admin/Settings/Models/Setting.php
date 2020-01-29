<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Models;

use Src\Core\Router;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

final class Setting extends Model
{
    use SoftDelete;

    protected string $table = 'setting';
    protected string $primaryKey = 'setting_ID';
    public string $key = 'setting_key';
    public string $valueKey = 'setting_value';
    protected string $softDeletedKey = 'setting_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    public function getByKey(string $key): ?stdClass
    {
        return $this->firstByAttributes([
            $this->key => $key
        ]);
    }
}
