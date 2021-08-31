<?php
declare(strict_types=1);

namespace System;

/**
 * Provides an interfaces for the states of the application.
 *
 * @package System
 */
interface StateInterface {

  /**
   * Defines states to determine if an process was successfully executed.
   *
   * @var string
   */
  public const SUCCESSFUL = 'successful';
  public const INFO = 'INFO';
  public const NOTICE = 'NOTICE';
  public const DEBUG = 'DEBUG';
  public const ERROR = 'ERROR';
  public const FAILED = 'failed';
  public const FORM_VALIDATION_FAILED = 'form_validation_failed';

}
