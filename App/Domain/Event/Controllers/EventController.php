<?php

namespace Domain\Event\Controllers;

use Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Pages\Repositories\PageRepository;
use Src\View\ViewInterface;
use System\View\DomainView;

/**
 *
 */
class EventController extends EventControllerBase {

  /**
   *
   */
  public function index(): ViewInterface {
    $eventRepo = new PageRepository($this->page->getBySlug('concerten'));
    $eventArchiveRepo = new PageRepository($this->page->getBySlug('concerten-historie'));

    return $this->view('index', [
      'title' => $eventRepo->getTitle(),
      'eventRepo' => $eventRepo,
      'eventArchiveRepo' => $eventArchiveRepo,
      'events' => $this->event->all(),
      'event_archive' => $this->eventArchive->getLimited(3),
      'amount_of_events' => $this->eventArchive->getAmountOfEvents(),
    ]);
  }

  /**
   *
   */
  public function show(): ViewInterface {
    $event = $this->event->getBySlug($this->event->getSlug());

    if ($event === NULL) {
      return $this->notFound();
    }

    $eventRepo = new EventRepository($event);
    return new DomainView($this->baseViewPath . 'show', [
      'title' => $eventRepo->getTitle(),
      'eventRepo' => $eventRepo,
    ]);
  }

}
