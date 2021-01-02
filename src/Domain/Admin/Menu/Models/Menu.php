<?php

namespace Domain\Admin\Menu\Models;

use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the menu table to interact with the database.
 *
 * @package Domain\Admin\Menu\Models
 */
final class Menu extends Model {
  use SoftDelete;

  protected string $table = 'menu';
  protected string $foreignTable = 'slug';
  protected string $primaryKey = 'menu_ID';
  public string $foreignKey = 'menu_slug_ID';
  public string $titleKey = 'menu_title';
  public string $weightKey = 'menu_weight';
  protected string $softDeletedKey = 'menu_is_deleted';

  protected string $primarySlugKey = 'slug_ID';
  protected string $slugKey = 'slug_name';
  protected string $slugSoftDeletedKey = 'slug_is_deleted';

  /**
   * Menu constructor.
   */
  public function __construct() {
    $this->addScope(
          (new DB)->innerJoin(
              $this->foreignTable,
              $this->primarySlugKey,
              $this->foreignKey
          )->where(
              $this->slugSoftDeletedKey,
              '=',
              '0'
          )
      );

    $this->initializeSoftDelete();
  }

  /**
   * @return object[]
   */
  public function getAll(): array {
    $this->addScope((new DB)->orderBy('asc', $this->weightKey));

    return $this->all();
  }

}
