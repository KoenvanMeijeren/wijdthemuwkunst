<?php
declare(strict_types=1);

namespace Components\Log;

use Components\ComponentsTrait;
use Throwable;
use Whoops\Handler\Handler;

/**
 * Provides a custom handler for logging data.
 *
 * @package Components\Log
 */
final class LoggerHandler extends Handler {

  use ComponentsTrait;

  /**
   * The error.
   *
   * @var string
   */
  protected string $error;

  /**
   * {@inheritDoc}
   */
  public function handle(): ?int {
    $this->buildStringException($this->getException());
    $this->buildStackTrace($this->getException());
    $this->log()->error($this->error);

    return Handler::DONE;
  }

  /**
   * Converts the exception into html.
   *
   * @param \Throwable $exception
   *   the exception to be prepared for the log.
   */
  protected function buildStringException(Throwable $exception): void {
    $this->error = "Exception: {$exception->getMessage()}";
    $this->error .= " on line {$exception->getLine()}";
    $this->error .= " in file {$exception->getFile()}";
    $this->error .= " in code {$exception->getCode()}";
  }

  /**
   * Builds the stack trace of the error.
   *
   * @param \Throwable $exception
   *   This is going to be prepared for the log.
   */
  protected function buildStackTrace(Throwable $exception): void {
    foreach ($exception->getTrace() as $trace) {
      if (isset($trace['line'])) {
        $this->error .= " on line {$trace['line']}";
      }

      if (isset($trace['file'])) {
        $this->error .= " in file {$trace['file']}";
      }

      if (isset($trace['function'])) {
        $this->error .= " in function {$trace['function']} ";
      }

      if (isset($trace['class'])) {
        $this->error .= " in class {$trace['class']} ";
      }
    }
  }

}
