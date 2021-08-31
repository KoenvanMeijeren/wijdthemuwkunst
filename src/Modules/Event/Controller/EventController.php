<?php
declare(strict_types=1);

namespace Modules\Event\Controller;

use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Event\Entity\Event;
use Modules\Event\Entity\EventInterface;
use Modules\Page\Entity\Page;
use System\Entity\EntityControllerBase;

/**
 * Provides a controller for events.
 *
 * @package Modules\Event\Controller
 */
class EventController extends EntityControllerBase {

  /**
   * EventController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Event::class, baseViewPath: 'Event/Views/');
  }

  /**
   * The index page of the events.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function index(): ViewInterface {
    $page_storage = $this->entityManager->getStorage(Page::class)->getRepository();
    $page = $page_storage->firstByAttributes([
      'slug_name' => 'concerten',
    ]);
    $archived_page = $page_storage->firstByAttributes([
      'slug_name' => 'concerten-historie',
    ]);
    $events = $this->repository->all();
    $archived_events = $this->repository->all(['*'], TRUE);

    return $this->view('index', [
      'title' => TranslationOld::get('home_page_title'),
      'page' => $page,
      'archived_page' => $archived_page,
      'events' => $events,
      'archived_events' => $archived_events,
    ]);
  }

  /**
   * Displays one event.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function show(): ViewInterface {
    $event = $this->repository->firstByAttributes([
      'slug_name' => $this->request()->getRouteParameter(),
    ]);

    if ($event instanceof EventInterface) {
      return $this->view('show', [
        'title' => $event->getTitle(),
        'event' => $event,
      ]);
    }

    return $this->notFound();
  }

  /**
   * Shows the default 404 page.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function notFound(): ViewInterface {
    return $this->view('404', [
      'title' => TranslationOld::get('page_not_found_title'),
      'content' => TranslationOld::get('page_not_found_description'),
    ]);
  }

}
