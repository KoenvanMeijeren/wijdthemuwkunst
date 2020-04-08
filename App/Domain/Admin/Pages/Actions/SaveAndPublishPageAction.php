<?php


namespace App\Domain\Admin\Pages\Actions;


use Domain\Admin\Pages\Actions\BasePageAction;
use Domain\Admin\Pages\Models\Page;
use Src\State\State;
use Src\Translation\Translation;

final class SaveAndPublishPageAction extends BasePageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->attributes['page_is_published'] = '1';

        $this->page->updateOrCreate($this->page->getId(), $this->attributes);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_updated'),
                $this->url
            )
        );

        return true;
    }

    protected function authorize(): bool
    {
        if ($this->pageRepository->getId() === 0) {
            return parent::authorize();
        }

        // Url cannot be edited if the page is static.
        $inMenu = $this->pageRepository->getInMenu();
        if ($inMenu === Page::PAGE_STATIC
            && $this->url !== $this->pageRepository->getSlug()
        ) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_static_slug_cannot_be_edited'),
                    $this->pageRepository->getSlug()
                )
            );
            return false;
        }

        // Visibility cannot be edited if the page is static.
        if ($inMenu === Page::PAGE_STATIC
            && $this->inMenu !== $inMenu
        ) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_static_cannot_be_edited'),
                    $this->pageRepository->getSlug()
                )
            );
            return false;
        }

        return parent::authorize();
    }
}
