<?php

namespace Src\Log;

use Src\Core\StateInterface;
use Src\Core\URI;

/**
 * Provides a trait for easy logging messages.
 *
 * @package Src\Log
 */
trait LoggerTrait {

  /**
   * Logs a application request.
   *
   * @param string $state
   *   The state of the application.
   * @param string $value
   *   The value to be logged.
   */
  public function logRequest(string $state, string $value): void {
    if ($state !== StateInterface::FAILED
      && $state !== StateInterface::SUCCESSFUL
      && $state !== StateInterface::FORM_VALIDATION_FAILED
    ) {
      return;
    }

    Log::appRequest($value, $state, URI::getUrl(), URI::getMethod());
  }

}
