<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Models;

use Src\Core\Router;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

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

        $this->addScope(
            (new DB)->orderBy(
                'DESC', $this->primaryKey
            )
        );
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    public function getByKey(string $key): ?string
    {
        return $this->firstByAttributes([
            $this->key => $key
        ]);
    }

    public function get(string $key): ?string
    {
        return $this->firstByAttributes([
            $this->key => $key
        ])->setting_value;
    }
}
