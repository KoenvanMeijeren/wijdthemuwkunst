<?php

namespace App\Domain\Admin\Text\Models;

use App\Domain\Admin\Text\Repositories\TextRepository;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the text table to interact with the database.
 *
 * @package App\Domain\Admin\Text\Models
 */
final class Text extends Model {
  use SoftDelete;

  protected string $table = 'translation';
  protected string $primaryKey = 'translation_ID';
  public string $key = 'translation_key';
  public string $valueKey = 'translation_value';
  public string $languageKey = 'translation_language';
  protected string $softDeletedKey = 'translation_is_deleted';

  /**
   * Text constructor.
   */
  public function __construct() {
    $this->initializeSoftDelete();
  }

  /**
   * Gets a text by the given key.
   *
   * @param string $key
   *   The key to search the setting for.
   *
   * @return string|null
   *   The setting.
   */
  public function getByKey(string $key): ?object {
    return $this->firstByAttributes([
      $this->key => $key,
    ]);
  }

  /**
   * Gets a text by the given key.
   *
   * @param string $key
   *   The key to search the setting for.
   * @param string $default
   *   The default value to return.
   *
   * @return string|null
   *   The setting.
   */
  public function get(string $key, string $default = ''): ?string {
    $text = new TextRepository($this->firstByAttributes([
      $this->key => $key,
    ]));

    return $text->getValue() !== '' ? $text->getValue() : $default;
  }

}
