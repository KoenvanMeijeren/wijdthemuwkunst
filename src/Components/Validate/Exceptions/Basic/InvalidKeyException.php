<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Basic;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an exception for undefined languages.
 *
 * @package Components\File\Exceptions
 */
final class InvalidKeyException extends Exception {

  /**
   * InvalidKeyException constructor.
   *
   * @param string $key
   *   The key.
   */
  #[Pure] public function __construct(string $key) {
    parent::__construct("No translation was found with key `{$key}`.");
  }

}
