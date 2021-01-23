<?php

declare(strict_types=1);


namespace Domain\Pages\Controllers;

use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Event\Models\Event;
use Domain\Pages\Models\Page;
use Components\Translation\TranslationOld;
use Src\View\ViewInterface;
use System\Controller\ControllerBase;

/**
 * The page controller.
 *
 * @package Domain\Pages\Controllers
 */
final class PageController extends ControllerBase {

  /**
   * The base path to the views directory.
   *
   * @var string
   */
  protected string $baseViewPath = 'Pages/Views/';

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
   * PageController constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->page = new Page();
    $this->event = new Event();
  }

  /**
   * Displays the index page of the website.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function index(): ViewInterface {
    $home = new PageRepository($this->page->getBySlug('home'));
    $events = new PageRepository($this->page->getBySlug('concerten'));

    return $this->view('index', [
      'title' => TranslationOld::get('home_page_title'),
      'homeRepo' => $home,
      'eventsRepo' => $events,
      'events' => $this->event->getLimited(3),
    ]);
  }

  /**
   * Try to find the dynamic 404 page or returns the default.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   */
  public function findOr404(): ViewInterface {
    $page = $this->page->getBySlug($this->page->getSlug());
    if ($page === NULL) {
      $page = $this->page->getBySlug('pagina-niet-gevonden');
    }

    if ($page !== NULL) {
      return $this->show(new PageRepository($page));
    }

    return $this->notFound();
  }

  /**
   * Shows a specific page.
   *
   * @param \Domain\Admin\Pages\Repositories\PageRepository $page
   *   The page to show.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   */
  public function show(PageRepository $page): ViewInterface {
    return $this->view('show', [
      'title' => $page->getTitle(),
      'pageRepo' => $page,
    ]);
  }

  /**
   * Shows the default 404 page.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function notFound(): ViewInterface {
    return $this->view('404', [
      'title' => TranslationOld::get('page_not_found_title'),
      'content' => TranslationOld::get('page_not_found_description'),
    ]);
  }

}
