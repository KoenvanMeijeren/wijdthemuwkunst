<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class CreatePageAction extends BasePageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
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
