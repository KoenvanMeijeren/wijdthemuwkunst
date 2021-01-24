<?php
declare(strict_types=1);

namespace Components\Log;

/**
 * Provides an interface for logging information.
 *
 * @package Components\Log
 */
interface LoggerInterface {

  /**
   * The format of the log message.
   *
   * @var string
   */
  public const LOG_FORMAT = '[%datetime%] %level_name% %message% %context% %extra%\n';

  /**
   * The time format of the log message.
   *
   * @var string
   */
  public const TIME_FORMAT = 'Y-m-d H:i:s';

  /**
   * Gets data from a specific log.
   *
   * @param string $date
   *   The date to get log data from.
   *
   * @return string
   *   The file content.
   */
  public function getFile(string $date): string;

  /**
   * Gets the logger.
   *
   * @return \Psr\Log\LoggerInterface
   *   The logger definition.
   */
  public function getLogger(): \Psr\Log\LoggerInterface;

  /**
   * Logs the request from the user for the application.
   *
   * @param string $state
   *   Specify the key if you want to add a state.
   * @param string $value
   *   The message.
   * @param string $url
   *   The url which the user is viewing.
   * @param string $method
   *   The used method to access the uri.
   */
  public function appRequest(string $value, string $state, string $url, string $method): void;

}
