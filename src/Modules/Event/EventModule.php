<?php
declare(strict_types=1);

namespace Modules\Event;

use System\Module\ModuleBase;

/**
 * Provides a module for pages.
 *
 * @package Modules\Event
 */
class EventModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return "Event";
  }

}
