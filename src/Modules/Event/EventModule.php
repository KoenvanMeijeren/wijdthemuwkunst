<?php
declare(strict_types=1);

namespace Modules\Event;

use Modules\Event\Controller\AdminEventController;
use Modules\Event\Controller\EventArchiveController;
use Modules\Event\Controller\EventController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for pages.
 *
 * @package Modules\Event
 */
#[Module(
  name: 'Event',
  routes: [
    EventController::class,
    AdminEventController::class,
    EventArchiveController::class,
  ]
)]
class EventModule extends ModuleBase {

}
