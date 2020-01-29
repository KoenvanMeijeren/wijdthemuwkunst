<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Src\Action\FormAction;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

final class DeletePageAction extends FormAction
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
        $this->page->delete($this->page->getId());

        if ($this->page->find($this->page->getId()) !== null) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_unsuccessfully_deleted'),
                    $this->pageRepository->getSlug()
                )
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_deleted'),
                $this->pageRepository->getSlug()
            )
        );

        return true;
    }

    protected function authorize(): bool
    {
        $user = new User();

        if ($user->getRights() !== User::DEVELOPER &&
            $this->pageRepository->getInMenu() === Page::PAGE_STATIC
        ) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_static_cannot_be_deleted'),
                    $this->pageRepository->getSlug()
                )
            );
            return false;
        }

        return parent::authorize();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
