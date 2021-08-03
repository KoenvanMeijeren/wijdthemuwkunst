<?php
declare(strict_types=1);

namespace Components\Header;

use Components\ComponentsTrait;
use JetBrains\PhpStorm\NoReturn;

/**
 * Redirects an user to a specified location.
 *
 * @package src\Core
 */
final class Redirect {

  use ComponentsTrait;

  /**
   * Construct the path and redirect to the path.
   *
   * @param string $path
   *   The path to redirect to.
   */
  #[NoReturn]
  public function __construct(
    protected string $path
  ) {
    $this->header()->redirect($this->path);
  }

}
