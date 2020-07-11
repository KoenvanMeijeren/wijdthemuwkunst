<?php

declare(strict_types=1);


namespace Domain\Pages\Models;

use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the page table to interact with the database.
 *
 * @package Domain\Pages\Models
 */
final class Page extends Model {

  use SoftDelete;

  /**
   * The table name.
   *
   * @var string
   */
  protected string $table = 'page';

  /**
   * The foreign table name.
   *
   * @var string
   */
  protected string $foreignTable = 'slug';

  /**
   * The primary key of the table.
   *
   * @var string
   */
  protected string $primaryKey = 'page_ID';

  /**
   * The foreign key of the table.
   *
   * @var string
   */
  protected string $foreignKey = 'page_slug_ID';

  /**
   * The primary key of the slug table.
   *
   * @var string
   */
  protected string $primarySlugKey = 'slug_ID';

  /**
   * The key of the slug column.
   *
   * @var string
   */
  protected string $slugKey = 'slug_name';

  /**
   * The key of the slug is deleted column.
   *
   * @var string
   */
  protected string $slugSoftDeletedKey = 'slug_is_deleted';

  /**
   * The key of the page in menu column.
   *
   * @var string
   */
  protected string $inMenu = 'page_in_menu';

  /**
   * The key of the page is published column.
   *
   * @var string
   */
  protected string $isPublishedKey = 'page_is_published';

  /**
   * The key of the page is deleted column.
   *
   * @var string
   */
  protected string $softDeletedKey = 'page_is_deleted';

  /**
   * Page constructor.
   */
  public function __construct() {
    $this->addScope((new DB)
      ->innerJoin($this->foreignTable, $this->primarySlugKey, $this->foreignKey)
      ->where($this->slugSoftDeletedKey, '=', '0')
      ->where($this->isPublishedKey, '=', '1')
    );

    $this->initializeSoftDelete();
  }

  /**
   * Gets pages by visibility.
   *
   * @param int $visibility
   *   The visibility of the pages.
   *
   * @return object[]
   *   The found pages.
   */
  public function getByVisibility(int $visibility): array {
    $this->addScope(
      (new DB)->where($this->inMenu, '=', (string) $visibility)
    );

    return $this->all(['*']);
  }

}
