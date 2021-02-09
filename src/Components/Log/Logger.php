<?php
declare(strict_types=1);

namespace Components\Log;

use Components\ComponentsTrait;
use Components\Datetime\DateTimeInterface;
use Components\SuperGlobals\Url\Uri;
use DateTimeZone;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonologLogger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
use Components\Env\Env;
use Components\File\File;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use System\StateInterface;

/**
 * Provides a class for logging information.
 *
 * @package Components\Log
 */
final class Logger implements LoggerInterface {

  use ComponentsTrait;

  /**
   * The logger definition.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected PsrLoggerInterface $logger;

  /**
   * Logger constructor.
   */
  public function __construct() {
    $format = self::LOG_FORMAT;
    $timeFormat = self::TIME_FORMAT;
    $dateTimeZone = new DateTimeZone(DateTimeInterface::DEFAULT_TIMEZONE);

    $this->logger = new MonologLogger($this->request()->env('app_name'));
    $this->logger->setTimezone($dateTimeZone);

    $this->logger->pushProcessor(new IntrospectionProcessor());
    $this->logger->pushProcessor(new ProcessIdProcessor());

    $formatter = new LineFormatter($format, $timeFormat);
    $formatter->ignoreEmptyContextAndExtra();

    $defaultHandler = new RotatingFileHandler(
      filename: START_PATH . '/storage/logs/app.log',
      maxFiles: 365,
      level: $this->env()->get() === Env::DEVELOPMENT ? MonologLogger::DEBUG : MonologLogger::INFO
    );
    $defaultHandler->setFormatter($formatter);

    $this->logger->pushHandler($defaultHandler);
    $this->logger->pushHandler(new FirePHPHandler());
    $this->logger->pushProcessor(new WebProcessor());
  }

  /**
   * {@inheritDoc}
   */
  public function getFile(string $date): string {
    $file = new File(directory: STORAGE_PATH . '/logs/', file: "app-{$date}.log");

    return $file->getContent();
  }

  /**
   * {@inheritDoc}
   */
  public function getLogger(): PsrLoggerInterface {
    return $this->logger;
  }

  /**
   * {@inheritDoc}
   */
  public function appRequest(string $value, string $state, string $url, string $method): void {
    $message = "{$method} request for page {$url} with message {$value}";
    if ($value === '') {
      $message = "{$method} request for page {$url}";
    }

    $this->logger->info("{$state} {$message}");
  }

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

    $this->appRequest($value, $state, Uri::getUrl(), Uri::getMethod());
  }

}
