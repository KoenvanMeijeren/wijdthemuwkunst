<?php

namespace Domain\Event\Controllers;

use Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Pages\Repositories\PageRepository;
use Components\View\ViewInterface;

/**
 * The event archive controller.
 *
 * @package Domain\Event\Controllers
 */
class EventArchiveController extends EventControllerBase {

  /**
   * Returns the archive of the events.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function index(): ViewInterface {
    $eventRepo = new PageRepository(
      $this->page->getBySlug('concerten-historie')
    );

    return $this->view('index-archive', [
      'title' => $eventRepo->getTitle(),
      'eventRepo' => $eventRepo,
      'events' => $this->eventArchive->all(),
    ]);
  }

  /**
   * Displays one event.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function show(): ViewInterface {
    $event = $this->eventArchive->getBySlug($this->eventArchive->getSlug());
    if ($event === NULL) {
      return $this->notFound();
    }

    $eventRepo = new EventRepository($event);
    return $this->view('show', [
      'title' => $eventRepo->getTitle(),
      'eventRepo' => $eventRepo,
    ]);
  }

}
