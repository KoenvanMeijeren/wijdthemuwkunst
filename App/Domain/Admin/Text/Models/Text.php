<?php


namespace App\Domain\Admin\Text\Models;


use App\Domain\Admin\Text\Repositories\TextRepository;
use Src\Core\Router;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

final class Text extends Model
{
    use SoftDelete;

    protected string $table = 'translation';
    protected string $primaryKey = 'translation_ID';
    public string $key = 'translation_key';
    public string $valueKey = 'translation_value';
    public string $languageKey = 'translation_language';
    protected string $softDeletedKey = 'translation_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    public function getId(): int
    {
        return (int)Router::getWildcard();
    }

    public function getByKey(string $key): ?object
    {
        return $this->firstByAttributes([
            $this->key => $key
        ]);
    }

    public function get(string $key, string $default = ''): ?string
    {
        $text = new TextRepository($this->firstByAttributes([
            $this->key => $key
        ]));

        return $text->getValue() !== '' ? $text->getValue() : $default;
    }
}
