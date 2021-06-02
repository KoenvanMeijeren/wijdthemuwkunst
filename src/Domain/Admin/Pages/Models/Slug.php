<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Models;

use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the slug table to interact with the database.
 *
 * @package Domain\Admin\Page\Models
 */
final class Slug extends Model {
  use SoftDelete;

  protected string $table = 'slug';
  protected string $primaryKey = 'slug_ID';
  protected string $softDeletedKey = 'slug_is_deleted';

  /**
   * Slug constructor.
   */
  public function __construct() {
    $this->initializeSoftDelete();
  }

  /**
   * Encode a string into a url-save string.
   *
   * Test string: Mess'd up --text-- just (to) stress /test/ ?our! `little` \\clean\\ url fun.ction!?-->
   *
   * @param string $slug
   *   The slug to be parsed.
   *
   * @return string
   *   The safely encoded url string.
   */
  public function parse(string $slug): string {
    return encode_url($slug);
  }

}
