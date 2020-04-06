<?php


namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

final class CreateEventAction extends BaseEventAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $event = $this->event->firstOrCreate($this->attributes);

        if ($event === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('event_unsuccessfully_created')
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('event_successfully_created'),
                $this->title
            )
        );

        return true;
    }
}
