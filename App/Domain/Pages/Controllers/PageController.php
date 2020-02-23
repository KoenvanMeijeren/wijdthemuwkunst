<?php
declare(strict_types=1);


namespace Domain\Pages\Controllers;

use Domain\Admin\Pages\Models\Page as AdminPage;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Pages\Models\Page;
use Src\Translation\Translation;
use Src\View\DomainView;

final class PageController
{
    private string $baseViewPath = 'Pages/Views/';
    private Page $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(): DomainView
    {
        $home = new PageRepository($this->page->getBySlug('home'));
        $events = new PageRepository($this->page->getBySlug('concerten'));

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('home_page_title'),
                'inMenuPages' => $this->getInMenuPages(),
                'homeRepo' => $home,
                'eventsRepo' => $events,
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
                'inMenuPages' => $this->getInMenuPages(),
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
                'inMenuPages' => $this->getInMenuPages(),
            ]
        );
    }

    private function getInMenuPages(): array
    {
        return $this->page->getByVisibility(AdminPage::PAGE_PUBLIC_IN_MENU);
    }
}
