<?php
declare(strict_types=1);

namespace Components\Actions;

/**
 * Provides an interface for subclasses of actions.
 *
 * @package Components\Actions
 */
interface ActionInterface {

  /**
   * Executes the validation and handles the request.
   *
   * @return bool
   *   If the action is executed successfully.
   */
  public function execute(): bool;

}
