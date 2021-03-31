<?php


namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class RemoveEventBannerAction extends BaseEventAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->event->update($this->eventRepository->getId(), [
            'event_banner_ID' => '0'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('event_banner_successfully_removed'),
                $this->eventRepository->getTitle()
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