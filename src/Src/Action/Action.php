<?php
declare(strict_types=1);

namespace Src\Action;

/**
 * Provides a base class for actions.
 *
 * @package src\Action
 */
abstract class Action implements ActionInterface {

  /**
   * Handles the action.
   *
   * @return bool
   *   Whether the action is executed successfully or not.
   */
  abstract protected function handle(): bool;

  /**
   * Authorizes the action before executing it.
   *
   * @return bool
   *   Whether the action is authorized successfully or not.
   */
  abstract protected function authorize(): bool;

  /**
   * Validates the action before executing it.
   *
   * @return bool
   *   Whether the action is valid or not.
   */
  abstract protected function validate(): bool;

  /**
   * {@inheritDoc}
   */
  final public function execute(): bool {
    if (!$this->authorize() || !$this->validate()) {
      return FALSE;
    }

    return $this->handle();
  }

}
