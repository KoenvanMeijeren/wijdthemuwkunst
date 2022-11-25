<?php
declare(strict_types=1);


namespace Components\SuperGlobals\Query;

use Components\Collection\CollectionStringBase;
use Components\Sanitize\Sanitize;

/**
 * Provides a class for Query.
 *
 * @package Components\SuperGlobals\Query;
 */
final class Query extends CollectionStringBase {

  /**
   * Query constructor.
   */
  public function __construct() {
    parent::__construct($_GET, TRUE, FALSE);
  }

}
