<?php

declare(strict_types=1);


namespace Src\Response;

use Src\Core\URI;

/**
 *
 */
final class Redirect {
  /**
   * The path to redirect to.
   *
   * @var string
   */
  private string $path;

  /**
   * Construct the path and redirect to the path.
   *
   * @param string $path
   *   the path to redirect to.
   */
  public function __construct(string $path) {
    $this->path = $path;

    $this->redirect();
  }

  /**
   * Redirect the path.
   */
  private function redirect(): void {
    URI::redirect($this->path);
  }

}
