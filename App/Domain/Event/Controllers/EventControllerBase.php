<?php

namespace App\Domain\Event\Controllers;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\EventArchive;
use App\System\Controller\ControllerBase;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Pages\Models\Page;
use Src\Translation\Translation;
use Src\View\ViewInterface;

/**
 *
 */
abstract class EventControllerBase extends ControllerBase {
  protected string $baseViewPath = 'Event/Views/';

  protected Page $page;
  protected EventArchive $eventArchive;
  protected Event $event;

  /**
   *
   */
  public function __construct() {
    parent::__construct();

    $this->page = new Page();
    $this->event = new Event();
    $this->eventArchive = new EventArchive();
  }

  /**
   *
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
      'title' => Translation::get('page_not_found_title'),
      'content' => Translation::get('page_not_found_description'),
    ]);
  }

}
