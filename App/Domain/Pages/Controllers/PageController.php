<?php
declare(strict_types=1);


namespace Domain\Pages\Controllers;

use App\Domain\Event\Models\Event;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Pages\Models\Page;
use Src\Translation\Translation;
use Src\View\DomainView;

final class PageController
{
    private string $baseViewPath = 'Pages/Views/';
    private Page $page;
    private Event $event;

    public function __construct()
    {
        $this->page = new Page();
        $this->event = new Event();
    }

    public function index(): DomainView
    {
        $home = new PageRepository($this->page->getBySlug('home'));
        $events = new PageRepository($this->page->getBySlug('concerten'));

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('home_page_title'),
                'homeRepo' => $home,
                'eventsRepo' => $events,
                'events' => $this->event->getLimited(3)
            ]
        );
    }

    public function findOr404(): DomainView
    {
        $page = $this->page->getBySlug($this->page->getSlug());
        if ($page === null) {
            $page = $this->page->getBySlug('pagina-niet-gevonden');
        }

        if ($page !== null) {
            return $this->show(new PageRepository($page));
        }

        return $this->notFound();
    }

    public function show(PageRepository $page): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'show',
            [
                'title' => $page->getTitle(),
                'pageRepo' => $page,
            ]
        );
    }

    public function notFound(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . '404',
            [
                'title' => Translation::get('page_not_found_title'),
                'content' => Translation::get('page_not_found_description'),
            ]
        );
    }
}
