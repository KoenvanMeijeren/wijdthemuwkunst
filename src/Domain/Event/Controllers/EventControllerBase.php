<?php

namespace Domain\Event\Controllers;

use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Event\Models\Event;
use Domain\Event\Models\EventArchive;
use Domain\Pages\Models\Page;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use System\Controller\ControllerBase;

/**
 * Provides a controller base for the event controllers.
 *
 * @package Domain\Event\Controllers
 */
abstract class EventControllerBase extends ControllerBase {

  /**
   * The page model definition.
   *
   * @var \Domain\Pages\Models\Page
   */
  protected Page $page;

  /**
   * The event model definition.
   *
   * @var \Domain\Event\Models\Event
   */
  protected Event $event;

  /**
   * The event archive model definition.
   *
   * @var \Domain\Event\Models\EventArchive
   */
  protected EventArchive $eventArchive;

  /**
   * EventControllerBase constructor.
   */
  public function __construct() {
    parent::__construct('Event/Views/');

    $this->page = new Page();
    $this->event = new Event();
    $this->eventArchive = new EventArchive();
  }

  /**
   * Returns a page not found view.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  protected function notFound(): ViewInterface {
    // Overwrite the base view path in order to return page not found views.
    $this->baseViewPath = 'Pages/Views/';

    if ($page = $this->page->getBySlug('pagina-niet-gevonden')) {
      $pageRepo = new PageRepository($page);

      return $this->view('show', [
        'title' => $pageRepo->getTitle(),
        'pageRepo' => $pageRepo,
      ]);
    }

    return $this->view('404', [
      'title' => TranslationOld::get('page_not_found_title'),
      'content' => TranslationOld::get('page_not_found_description'),
    ]);
  }

}
