<?php


namespace App\Domain\Admin\Event\Actions;


use App\Domain\Admin\Event\Models\Event;
use App\Domain\Admin\Event\Repositories\EventRepository;
use Src\Action\FormAction;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

final class UnPublishEventAction extends FormAction
{
    private Event $event;
    private EventRepository $eventRepository;
    private Session $session;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->session = new Session();
        $this->eventRepository = new EventRepository($event->find($event->getId()));
    }

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
