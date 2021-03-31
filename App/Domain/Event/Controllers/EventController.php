<?php


namespace App\Domain\Event\Controllers;

use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\EventArchive;
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
    private EventArchive $eventArchive;

    public function __construct()
    {
        $this->page = new Page();
        $this->event = new Event();
        $this->eventArchive = new EventArchive();
    }

    public function index(): DomainView
    {
        $eventRepo = new PageRepository($this->page->getBySlug('concerten'));
        $eventArchiveRepo = new PageRepository($this->page->getBySlug('concerten-historie'));

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => $eventRepo->getTitle(),
                'eventRepo' => $eventRepo,
                'eventArchiveRepo' => $eventArchiveRepo,
                'events' => $this->event->all(),
                'event_archive' => $this->eventArchive->getLimited(3),
                'amount_of_events' => $this->eventArchive->getAmountOfEvents()
            ]
        );
    }

    public function show(): DomainView
    {
        $event = $this->event->getBySlug($this->event->getSlug());

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