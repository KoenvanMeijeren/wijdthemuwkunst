<?php


namespace App\Domain\Admin\ContactForm\Model;


use Cake\Chronos\Chronos;
use Src\Core\Router;
use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

final class ContactForm extends Model
{
    use SoftDelete;

    protected string $table = 'contact_form';
    protected string $primaryKey = 'contact_form_ID';
    protected string $nameKey = 'contact_form_name';
    protected string $emailKey = 'contact_form_email';
    protected string $messageKey = 'contact_form_message';
    protected string $createdAtKey = 'contact_form_created_at';
    protected string $softDeletedKey = 'contact_form_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    /**
     * Get all records.
     *
     * @return object[]
     */
    public function getAll(): array
    {
        $this->addScope(
            (new DB)->orderBy('desc', $this->createdAtKey)
        );

        return $this->all();
    }

    /**
     * Get all records for the given date.
     *
     * @param string $date The date to filter on.
     *
     * @return object[]
     */
    public function getByDate(string $date): array
    {
        $datetime = new Chronos($date);

        $this->addScope(
            (new DB)->whereBetween(
                $this->createdAtKey,
                $datetime->toDateString() . ' 00:00:00',
                $datetime->toDateString() . ' 23:59:59'
            )->orderBy('desc', $this->createdAtKey)
        );

        return $this->all();
    }

    public function getId(): int
    {
        return (int) Router::getWildcard();
    }
}
