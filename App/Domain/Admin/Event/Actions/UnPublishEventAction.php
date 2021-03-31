<?php


namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class UnPublishEventAction extends BaseEventAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->event->update($this->eventRepository->getId(), [
            'event_is_published' => '0'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('event_successfully_unpublished'),
                $this->eventRepository->getTitle()
            )
        );

        return true;
    }

    protected function validate(): bool
    {
        return true;
    }
}