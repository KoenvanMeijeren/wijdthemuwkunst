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

  protected string $table = 'page';
  protected string $foreignTable = 'slug';
  protected string $primaryKey = 'page_ID';
  protected string $foreignKey = 'page_slug_ID';
  protected string $primarySlugKey = 'slug_ID';
  protected string $slugKey = 'slug_name';
  protected string $slugSoftDeletedKey = 'slug_is_deleted';
  protected string $inMenu = 'page_in_menu';
  protected string $isPublishedKey = 'page_is_published';
  protected string $softDeletedKey = 'page_is_deleted';

  /**
   * Page constructor.
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
          )->where(
              $this->isPublishedKey,
              '=',
              '1'
          )
      );

    $this->initializeSoftDelete();
  }

  /**
   * Gets pages by visibility.
   *
   * @param int $visibility
   *
   * @return object[]
   *   The found pages.
   */
  public function getByVisibility(int $visibility): array {
    $this->addScope(
          (new DB)->where(
              $this->inMenu,
              '=',
              (string) $visibility
          )
      );

    return $this->all(['*']);
  }

}
