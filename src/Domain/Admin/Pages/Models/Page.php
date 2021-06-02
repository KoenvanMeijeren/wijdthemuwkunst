<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Models;

use Components\Database\Query;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the page table to interact with the database.
 *
 * @package Domain\Admin\Page\Models
 */
final class Page extends Model {
  use SoftDelete;

  protected string $table = 'page';
  protected string $foreignTable = 'slug';
  protected string $primaryKey = 'page_ID';
  protected string $foreignKey = 'page_slug_ID';
  protected string $primarySlugKey = 'slug_ID';
  protected string $slugKey = 'slug_name';
  protected string $slugSoftDeletedKey = 'slug_is_deleted';
  protected string $isPublishedKey = 'page_is_published';
  protected string $softDeletedKey = 'page_is_deleted';

  /**
   * Possible page visibility options.
   * - Page is normal
   * - Page is static.
   *
   * @var int
   */
  public const PAGE_NORMAL = 1;
  public const PAGE_STATIC = 2;

  /**
   * Page constructor.
   */
  public function __construct() {
    $this->addScope(
          (new Query($this->table))
            ->innerJoin($this->foreignTable, $this->primarySlugKey, $this->foreignKey)
            ->where($this->slugSoftDeletedKey, '=', '0')
      );

    $this->initializeSoftDelete();
  }

}
