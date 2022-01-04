<?php

namespace System;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for application states.
 *
 * @package System
 */
enum State: string {
  case SUCCESSFUL = 'successful';
  case INFO = 'INFO';
  case NOTICE = 'NOTICE';
  case DEBUG = 'DEBUG';
  case ERROR = 'ERROR';
  case FAILED = 'failed';
  case FORM_VALIDATION_FAILED = 'form_validation_failed';

  /**
   * Determines if the state is equal to the given one.
   *
   * @param string $state
   *   The state.
   *
   * @return bool
   *   Whether the state is equal or not.
   */
  public function isEqualString(string $state): bool {
    return $this->value === $state;
  }

  /**
   * Determines if the state is equal to the given one.
   *
   * @param string $state
   *   The state.
   *
   * @return bool
   *   Whether the state is equal or not.
   */
  #[Pure] public function isEqual(State $state): bool {
    return $this->isEqualString($state->value);
  }

  /**
   * Determines if the state is part of the given one.
   *
   * @param string $string
   *   The haystack string.
   *
   * @return bool
   *   Whether the state is part of the given one or not.
   */
  public function isPartOf(string $string): bool {
    return str_contains($string, $this->value);
  }

}
