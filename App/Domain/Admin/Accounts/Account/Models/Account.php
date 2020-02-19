<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Models;

use Src\Core\Router;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

final class Account extends Model
{
    use SoftDelete;

    protected string $table = 'account';
    protected string $primaryKey = 'account_ID';
    protected string $softDeletedKey = 'account_is_deleted';

    /**
     * The hash method of the account password.
     *
     * @var int
     */
    public const PASSWORD_HASH_METHOD = PASSWORD_ARGON2ID;

    public function __construct()
    {
        $this->initializeSoftDelete();

        $this->addScope(
            (new DB)->orderBy(
                'DESC', $this->primaryKey
            )
        );
    }

    /**
     * Get the id of the account.
     *
     * @return int
     */
    public function getId(): int
    {
        return (int) Router::getWildcard();
    }

    /**
     * Get an account by the given email.
     *
     * @param string $email
     *
     * @return stdClass|null
     */
    public function getByEmail(string $email): ?stdClass
    {
        return $this->firstByAttributes([
            'account_email' => $email
        ]);
    }
}
