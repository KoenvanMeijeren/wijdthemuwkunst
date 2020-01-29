<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Src\State\State;
use Src\Translation\Translation;

final class UpdatePageAction extends PageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->update($this->page->getId(), [
            'page_slug_ID' => (string) $this->getSlugId(),
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ]);

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
