<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Controllers;

use Domain\Admin\Pages\Actions\CreatePageAction;
use Domain\Admin\Pages\Actions\DeletePageAction;
use Domain\Admin\Pages\Actions\PublishPageAction;
use Domain\Admin\Pages\Actions\UnPublishPageAction;
use Domain\Admin\Pages\Actions\UpdatePageAction;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\ViewModels\EditViewModel;
use Domain\Admin\Pages\ViewModels\IndexViewModel;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class PageController
{
    private Page $page;

    private string $baseViewPath = 'Admin/Pages/Views/';
    private string $redirectBack = '/admin/pages';
    private string $redirectSame = '/admin/page/edit/';

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(): DomainView
    {
        $pages = new IndexViewModel($this->page->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_page_title'),
                'pages' => $pages->table()
            ]
        );
    }

    public function create(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => Translation::get('admin_create_page_title')
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreatePageAction($this->page);
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->create();
    }

    public function edit(): DomainView
    {
        $page = new EditViewModel(
            $this->page->find($this->page->getId())
        );
        $pageRepository = new PageRepository($page->get());

        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => sprintf(
                    Translation::get('admin_edit_page_title'),
                    $pageRepository->getSlug()
                ),
                'page' => $page->get()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdatePageAction($this->page);
        if ($update->execute()) {
            return new Redirect($this->redirectSame . $this->page->getId());
        }

        return $this->edit();
    }

    public function publish(): Redirect
    {
        $publish = new PublishPageAction($this->page);
        $publish->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function unPublish(): Redirect
    {
        $unPublish = new UnPublishPageAction($this->page);
        $unPublish->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function destroy(): Redirect
    {
        $delete = new DeletePageAction($this->page);
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
