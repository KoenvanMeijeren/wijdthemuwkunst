<?php


namespace App\Domain\Event\Controllers;


use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Event\Models\Event;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Pages\Models\Page;
use Src\Translation\Translation;
use Src\View\DomainView;

class EventController
{
    private string $baseViewPath = 'Event/Views/';
    private string $pageViewPath = 'Pages/Views/';
    private Page $page;
    private Event $event;

    public function __construct()
    {
        $this->page = new Page();
        $this->event = new Event();
    }

    public function index(): DomainView
    {
        $eventRepo = new PageRepository($this->page->getBySlug('concerten'));

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => $eventRepo->getTitle(),
                'eventRepo' => $eventRepo,
                'events' => $this->event->all(),
            ]
        );
    }

    public function show(): DomainView
    {
        $event = $this->event->find($this->event->getId());

        if ($event === null) {
            return $this->notFound();
        }

        $eventRepo = new EventRepository($event);
        return new DomainView(
            $this->baseViewPath . 'show',
            [
                'title' => $eventRepo->getTitle(),
                'eventRepo' => $eventRepo,
            ]
        );
    }

    public function notFound(): DomainView
    {
        $page = $this->page->getBySlug('pagina-niet-gevonden');

        if ($page !== null) {
            $pageRepo = new PageRepository($page);
            return new DomainView(
                $this->pageViewPath . 'show',
                [
                    'title' => $pageRepo->getTitle(),
                    'pageRepo' => $pageRepo,
                ]
            );
        }

        return new DomainView(
            $this->pageViewPath . '404',
            [
                'title' => Translation::get('page_not_found_title'),
                'content' => Translation::get('page_not_found_description'),
            ]
        );
    }
}
