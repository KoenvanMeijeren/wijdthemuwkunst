<?php

declare(strict_types=1);


namespace Src\Core;

/**
 * Defines states for the application.
 *
 * @package src\Core
 */
interface StateInterface {

  /**
   * Define states to determine if an process was successfully executed.
   *
   * @var string
   */
  public const SUCCESSFUL = 'successful';
  public const ERROR = 'ERROR';
  public const FAILED = 'failed';
  public const FORM_VALIDATION_FAILED = 'form_validation_failed';

}
