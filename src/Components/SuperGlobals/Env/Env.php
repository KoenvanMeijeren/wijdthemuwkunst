<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Env;

use Components\Collection\CollectionStringBase;

/**
 * Provides a class for Environment values.
 *
 * @package Components\SuperGlobals\Env;
 */
final class Env extends CollectionStringBase {

  /**
   * Env constructor.
   */
  public function __construct() {
    parent::__construct($_ENV, FALSE, FALSE);
  }

}
