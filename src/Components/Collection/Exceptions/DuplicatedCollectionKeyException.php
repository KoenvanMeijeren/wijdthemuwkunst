<?php
declare(strict_types=1);

namespace Components\Collection\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an exception for duplicated collection items.
 *
 * @package Components\Collection\Exceptions
 */
final class DuplicatedCollectionKeyException extends Exception {

  /**
   * DuplicatedCollectionKeyException constructor.
   *
   * @param string $key
   *   The duplicated key.
   */
  #[Pure] public function __construct(string $key) {
    parent::__construct("The `{$key}` has already a value in the collection.");
  }

}
