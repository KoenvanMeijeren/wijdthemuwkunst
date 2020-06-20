<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Controllers;

use App\Domain\Admin\Pages\Actions\SaveAndPublishPageAction;
use App\System\Controller\AdminControllerBase;
use Domain\Admin\Pages\Actions\CreatePageAction;
use Domain\Admin\Pages\Actions\DeletePageAction;
use Domain\Admin\Pages\Actions\PublishPageAction;
use Domain\Admin\Pages\Actions\RemovePageBannerAction;
use Domain\Admin\Pages\Actions\RemovePageThumbnailAction;
use Domain\Admin\Pages\Actions\UnPublishPageAction;
use Domain\Admin\Pages\Actions\UpdatePageAction;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\ViewModels\EditViewModel;
use Domain\Admin\Pages\ViewModels\PageTable;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class PageControllerBase extends AdminControllerBase
{
    private Page $page;

    protected string $baseViewPath = 'Admin/Pages/Views/';
    private string $redirectBack = '/admin/content/pages';
    private string $redirectSame = '/admin/content/pages/page/edit/';

    public function __construct()
    {
        parent::__construct();

        $this->page = new Page();
    }

    public function index(): DomainView
    {
        $pageTable = new PageTable($this->page->all());

        return $this->view('index', [
            'title' => Translation::get('admin_page_title'),
            'pages' => $pageTable->get(),
        ]);
    }

    public function create(): DomainView
    {
        return $this->view('edit', [
            'title' => Translation::get('admin_create_page_title')
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreatePageAction();
        if (array_key_exists('save-and-publish', $_POST)) {
            $create = new SaveAndPublishPageAction();
        }

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

        return $this->view('edit', [
            'title' => sprintf(
                Translation::get('admin_edit_page_title'),
                $pageRepository->getSlug()
            ),
            'page' => $page->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdatePageAction();
        if (array_key_exists('save-and-publish', $_POST)) {
            $update = new SaveAndPublishPageAction();
        }

        if ($update->execute()) {
            return new Redirect($this->redirectSame . $this->page->getId());
        }

        return $this->edit();
    }

    public function publish(): Redirect
    {
        $publish = new PublishPageAction();
        $publish->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function unPublish(): Redirect
    {
        $unPublish = new UnPublishPageAction();
        $unPublish->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function removeThumbnail(): Redirect
    {
        $removeThumbnail = new RemovePageThumbnailAction();
        $removeThumbnail->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function removeBanner(): Redirect
    {
        $removeBanner = new RemovePageBannerAction();
        $removeBanner->execute();

        return new Redirect($this->redirectSame . $this->page->getId());
    }

    public function destroy(): Redirect
    {
        $delete = new DeletePageAction();
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
