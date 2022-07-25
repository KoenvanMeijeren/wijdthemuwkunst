<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Server;

use Components\Collection\CollectionStringBase;
use Components\SuperGlobals\ServerOptions;

/**
 * Provides a class for Server.
 *
 * @package Components\SuperGlobals\Query;
 */
final class Server extends CollectionStringBase {

  /**
   * Server constructor.
   */
  public function __construct() {
    parent::__construct($_SERVER, FALSE, FALSE);
  }

  /**
   * {@inheritdoc}
   */
  public function get(string|ServerOptions $key, mixed $default = '', bool $unset = FALSE): string {
    if ($key instanceof ServerOptions) {
      $key = $key->value;
    }

    return parent::get($key, $default, $unset);
  }

}
