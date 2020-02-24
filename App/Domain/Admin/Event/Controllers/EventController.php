<?php


namespace Domain\Admin\Event\Controllers;


use App\Domain\Admin\Event\Actions\CreateEventAction;
use App\Domain\Admin\Event\Actions\DeleteEventAction;
use App\Domain\Admin\Event\Actions\PublishEventAction;
use App\Domain\Admin\Event\Actions\RemoveEventBannerAction;
use App\Domain\Admin\Event\Actions\RemoveEventThumbnailAction;
use App\Domain\Admin\Event\Actions\UnPublishEventAction;
use App\Domain\Admin\Event\Actions\UpdateEventAction;
use App\Domain\Admin\Event\Models\Event;
use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Event\ViewModels\EditViewModel;
use App\Domain\Admin\Event\ViewModels\IndexViewModel;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class EventController
{
    private Event $event;

    private string $baseViewPath = 'Admin/Event/Views/';
    private string $redirectBack = '/admin/concerten';
    private string $redirectSame = '/admin/concert/edit/';

    public function __construct()
    {
        $this->event = new Event();
    }

    public function index(): DomainView
    {
        $events = new IndexViewModel($this->event->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_event_title'),
                'events' => $events->table()
            ]
        );
    }

    public function create(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => Translation::get('admin_create_event_title')
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateEventAction($this->event);
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->create();
    }

    public function edit(): DomainView
    {
        $event = new EditViewModel(
            $this->event->find($this->event->getId())
        );
        $eventRepository = new EventRepository($event->get());

        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => sprintf(
                    Translation::get('admin_edit_event_title'),
                    $eventRepository->getTitle()
                ),
                'event' => $event->get()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateEventAction($this->event);
        if ($update->execute()) {
            return new Redirect($this->redirectSame . $this->event->getId());
        }

        return $this->edit();
    }

    public function publish(): Redirect
    {
        $publish = new PublishEventAction($this->event);
        $publish->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function unPublish(): Redirect
    {
        $unPublish = new UnPublishEventAction($this->event);
        $unPublish->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function removeThumbnail(): Redirect
    {
        $removeThumbnail = new RemoveEventThumbnailAction($this->event);
        $removeThumbnail->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function removeBanner(): Redirect
    {
        $removeBanner = new RemoveEventBannerAction($this->event);
        $removeBanner->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteEventAction($this->event);
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
