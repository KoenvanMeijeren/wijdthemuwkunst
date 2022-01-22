<?php
declare(strict_types=1);

namespace Modules\Event\Controller;

use Components\Route\RouteGet;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Event\Entity\Event;
use Modules\Event\Entity\EventInterface;
use Modules\Page\Entity\Page;
use System\Entity\EntityControllerBase;

/**
 * The event archive controller.
 *
 * @package Modules\Event\Controller
 */
class EventArchiveController extends EntityControllerBase {

  /**
   * EventController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Event::class, baseViewPath: 'Event/Views/');
  }

  /**
   * Returns the archive of the events.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet(url: 'concerten/historie')]
  public function index(): ViewInterface {
    $page_storage = $this->entityManager->getStorage(Page::class)->getRepository();
    $archived_page = $page_storage->firstByAttributes([
      'slug_name' => 'concerten-historie',
    ]);
    $archived_events = $this->repository->all(archived: TRUE);

    return $this->view('index-archive', [
      'title' => TranslationOld::get('home_page_title'),
      'page' => $archived_page,
      'events' => $archived_events,
    ]);
  }

  /**
   * Displays one event.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet(url: 'concerten/historie/concert/{slug}')]
  public function show(): ViewInterface {
    $event = $this->repository->firstByAttributes([
      'slug_name' => $this->request()->getRouteParameter(),
    ], archived: TRUE);

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
