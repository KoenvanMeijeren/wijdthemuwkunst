<?php

declare(strict_types=1);


namespace Src\Action;

/**
 * Provides a base class for actions.
 *
 * @package Src\Action
 */
abstract class Action implements ActionInterface {

  /**
   * Handle the request and execute the action.
   *
   * @return bool
   *   If the action is handled successfully.
   */
  abstract protected function handle(): bool;

  /**
   * Authorize the request for the action.
   *
   * @return bool
   *   If the action is authorized successfully.
   */
  abstract protected function authorize(): bool;

  /**
   * Validate the given input.
   *
   * @return bool
   *   If the action is validated successfully.
   */
  abstract protected function validate(): bool;

  /**
   * {@inheritDoc}
   */
  final public function execute(): bool {
    if ($this->authorize() && $this->validate()) {
      return $this->handle();
    }

    return FALSE;
  }

}
