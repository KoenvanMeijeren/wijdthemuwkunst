<?php
declare(strict_types=1);

namespace Components\Actions;

use Components\ComponentsTrait;

/**
 * Provides a base class for actions.
 *
 * @package Components\Actions
 */
abstract class Action implements ActionInterface {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  final public function execute(): bool {
    return $this->authorize() && $this->validate() && $this->handle();
  }

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

}
