<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Post;

use Components\Collection\CollectionStringBase;

/**
 * Provides a class for Post.
 *
 * @package Components\SuperGlobals\Post;
 */
final class Post extends CollectionStringBase {

  /**
   * Query constructor.
   */
  public function __construct() {
    parent::__construct($_POST, TRUE, FALSE);
  }

}
