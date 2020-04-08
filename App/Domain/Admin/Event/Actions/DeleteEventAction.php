<?php


namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class DeleteEventAction extends BaseEventAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->event->delete($this->event->getId());

        if ($this->event->find($this->event->getId()) !== null) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('event_unsuccessfully_deleted'),
                    $this->eventRepository->getTitle()
                )
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('event_successfully_deleted'),
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
