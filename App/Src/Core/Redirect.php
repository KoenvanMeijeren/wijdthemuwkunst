<?php

declare(strict_types=1);


namespace Src\Core;

/**
 * Redirects an user to a specified location.
 *
 * @package Src\Core
 */
final class Redirect {

  /**
   * The path to redirect to.
   *
   * @var string
   */
  protected string $path;

  /**
   * Construct the path and redirect to the path.
   *
   * @param string $path
   *   The path to redirect to.
   */
  public function __construct(string $path) {
    $this->path = $path;

    $this->redirect();
  }

  /**
   * Redirect the path.
   */
  protected function redirect(): void {
    URI::redirect($this->path);
  }

}
