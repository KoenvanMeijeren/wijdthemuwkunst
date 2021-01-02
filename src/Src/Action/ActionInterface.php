<?php

namespace Src\Action;

/**
 * An interface for subclasses which implements actions.
 *
 * @package src\Action
 */
interface ActionInterface {

  /**
   * Execute the validation and handle the request.
   *
   * @return bool
   *   If the action is executed successfully.
   */
  public function execute(): bool;

}
