<?php
declare(strict_types=1);


namespace Src\Model\Scopes\SoftDelete;

use Src\Database\DB;

trait SoftDelete
{
    abstract protected function addScope(DB $builder): void;

    public function initializeSoftDelete(): void
    {
        $this->addScope(
            (new DB)->where($this->softDeletedKey, '=', '0')
        );
    }
}
