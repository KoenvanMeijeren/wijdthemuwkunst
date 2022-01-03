<?php
declare(strict_types=1);

namespace Components\Log;

use Components\ComponentsTrait;
use Components\Datetime\DateTimeInterface;
use Components\Env\EnvInterface;
use Components\File\Exceptions\FileNotFoundException;
use Components\File\File;
use Components\SuperGlobals\Url\Uri;
use DateTimeZone;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonologLogger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
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
  protected PsrLoggerInterface $psrLogger;

  /**
   * Logger constructor.
   */
  public function __construct() {
    $format = self::LOG_FORMAT;
    $timeFormat = self::TIME_FORMAT;
    $dateTimeZone = new DateTimeZone(DateTimeInterface::DEFAULT_TIMEZONE);

    $this->psrLogger = new MonologLogger($this->request()->env('app_name'));
    $this->psrLogger->setTimezone($dateTimeZone);

    $this->psrLogger->pushProcessor(new IntrospectionProcessor());
    $this->psrLogger->pushProcessor(new ProcessIdProcessor());

    $formatter = new LineFormatter($format, $timeFormat);
    $formatter->ignoreEmptyContextAndExtra();

    $defaultHandler = new RotatingFileHandler(
      filename: START_PATH . '/storage/logs/app.log',
      maxFiles: 365,
      level: $this->env()->get() === EnvInterface::DEVELOPMENT ? MonologLogger::DEBUG : MonologLogger::INFO
    );
    $defaultHandler->setFormatter($formatter);

    $this->psrLogger->pushHandler($defaultHandler);
    $this->psrLogger->pushHandler(new FirePHPHandler());
    $this->psrLogger->pushProcessor(new WebProcessor());
  }

  /**
   * {@inheritDoc}
   */
  public function getFile(string $date): string {
    try {
      return (new File(directory: STORAGE_PATH . '/logs/', file: "app-{$date}.log"))->getContent();
    } catch (FileNotFoundException $exception) {
      return '';
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getLogger(): PsrLoggerInterface {
    return $this->psrLogger;
  }

  /**
   * {@inheritDoc}
   */
  public function appRequest(string $value, string $state, string $url, string $method): void {
    $message = "{$method} request for page {$url} with message {$value}";
    if ($value === '') {
      $message = "{$method} request for page {$url}";
    }

    $this->psrLogger->info("{$state} {$message}");
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
      && $state !== StateInterface::FORM_VALIDATION_FAILED) {
      return;
    }

    $this->appRequest($value, $state, Uri::getUrl(), Uri::getHttpType()->value);
  }

}
