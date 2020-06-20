<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\Models;

use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the settings table to interact with the database.
 *
 * @package Domain\Admin\Settings\Models
 */
final class Setting extends Model {
  use SoftDelete;

  protected string $table = 'setting';
  protected string $primaryKey = 'setting_ID';
  public string $key = 'setting_key';
  public string $valueKey = 'setting_value';
  protected string $softDeletedKey = 'setting_is_deleted';

  /**
   * Setting constructor.
   */
  public function __construct() {
    $this->initializeSoftDelete();
  }

  /**
   * Gets a setting by the given key.
   *
   * @param string $key
   *   The key to search the setting for.
   *
   * @return string|null
   *   The setting.
   */
  public function getByKey(string $key): ?string {
    return $this->firstByAttributes([
      $this->key => $key,
    ]);
  }

  /**
   * Gets a setting by the given key.
   *
   * @param string $key
   *   The key to search the setting for.
   *
   * @return string|null
   *   The setting.
   */
  public function get(string $key): string {
    $setting = $this->firstByAttributes([
      $this->key => $key,
    ]);

    return $setting !== NULL ? $setting->setting_value : '';
  }

}
