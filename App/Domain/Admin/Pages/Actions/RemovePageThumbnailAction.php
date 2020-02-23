<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Src\Action\FormAction;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

final class RemovePageThumbnailAction extends FormAction
{
    private Page $page;
    private PageRepository $pageRepository;
    private Session $session;

    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->session = new Session();
        $this->pageRepository = new PageRepository($page->find($page->getId()));
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->update($this->pageRepository->getId(), [
            'page_thumbnail_ID' => '0'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_banner_successfully_removed'),
                $this->pageRepository->getSlug()
            )
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
