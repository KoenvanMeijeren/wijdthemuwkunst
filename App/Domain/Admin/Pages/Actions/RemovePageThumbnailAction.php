<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class RemovePageThumbnailAction extends BasePageAction
{
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
