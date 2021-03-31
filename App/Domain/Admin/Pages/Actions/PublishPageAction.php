<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Src\State\State;
use Src\Translation\Translation;

final class PublishPageAction extends BasePageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->update($this->pageRepository->getId(), [
            'page_is_published' => '1'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_published'),
                $this->pageRepository->getSlug()
            )
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if ($this->pageRepository->getInMenu() === Page::PAGE_STATIC) {
            $this->session->flash(
                State::FAILED,
                Translation::get('page_static_cannot_be_published')
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