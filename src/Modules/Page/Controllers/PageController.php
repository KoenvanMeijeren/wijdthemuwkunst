<?php
declare(strict_types=1);

namespace Modules\Page\Controllers;

use Components\Route\RouteGet;
use Components\Route\RouterInterface;
use Components\SuperGlobals\Url\Uri;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Event\Entity\Event;
use Modules\Page\Entity\Page;
use Modules\Page\Entity\PageInterface;
use System\Entity\EntityControllerBase;

/**
 * Provides a controller for displaying pages.
 *
 * @package Modules\Page\Controllers
 */
final class PageController extends EntityControllerBase {

  /**
   * AdminPageController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Page::class, baseViewPath: 'Page/Views/');
  }

  /**
   * Displays the index page of the website.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  #[RouteGet(url: '')]
  public function index(): ViewInterface {
    $page = $this->repository->firstByAttributes([
      'slug_name' => 'home',
    ]);
    $event_page = $this->repository->firstByAttributes([
      'slug_name' => 'concerten',
    ]);
    $event_storage = $this->entityManager->getStorage(Event::class)->getRepository();
    $events = $event_storage->all();

    return $this->view('index', [
      'title' => TranslationOld::get('home_page_title'),
      'page' => $page,
      'event_page' => $event_page,
      'events' => $events,
    ]);
  }

  /**
   * Try to find the dynamic 404 page or returns the default.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet(url: RouterInterface::URL_PAGE_NOT_FOUND)]
  public function findOr404(): ViewInterface {
    $page = $this->repository->firstByAttributes([
      'slug_name' => Uri::getUrl(),
    ]);
    if ($page === NULL) {
      $page = $this->repository->firstByAttributes([
        'slug_name' => 'pagina-niet-gevonden',
      ]);
    }

    if ($page instanceof PageInterface) {
      return $this->show($page);
    }

    return $this->notFound();
  }

  /**
   * Shows a specific page.
   *
   * @param \Modules\Page\Entity\PageInterface $page
   *   The page to show.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function show(PageInterface $page): ViewInterface {
    return $this->view('show', [
      'title' => $page->getTitle(),
      'page' => $page,
    ]);
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
