<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Src\State\State;
use Src\Translation\Translation;

final class CreatePageAction extends PageAction
{
    private array $attributes = [];

    private function prepare(): void
    {
        $this->attributes = [
            'page_slug_ID' => (string) $this->getSlugId(),
            'page_thumbnail_ID' => $this->thumbnailID,
            'page_banner_ID' => $this->bannerID,
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ];

        if ($this->inMenu === Page::PAGE_STATIC) {
            $this->attributes['page_is_published'] = '1';
        }
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->prepare();

        $page = $this->page->firstOrCreate($this->attributes);

        if ($page === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('page_unsuccessfully_created')
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_created'),
                $this->url
            )
        );

        return true;
    }
}
