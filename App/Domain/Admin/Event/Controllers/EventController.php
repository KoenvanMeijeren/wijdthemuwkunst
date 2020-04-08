<?php


namespace Domain\Admin\Event\Controllers;

use App\Domain\Admin\Event\Actions\ActivateEventAction;
use App\Domain\Admin\Event\Actions\ArchiveEventAction;
use App\Domain\Admin\Event\Actions\CreateEventAction;
use App\Domain\Admin\Event\Actions\DeleteEventAction;
use App\Domain\Admin\Event\Actions\PublishEventAction;
use App\Domain\Admin\Event\Actions\RemoveEventBannerAction;
use App\Domain\Admin\Event\Actions\RemoveEventThumbnailAction;
use App\Domain\Admin\Event\Actions\SaveAndPublishEventAction;
use App\Domain\Admin\Event\Actions\UnPublishEventAction;
use App\Domain\Admin\Event\Actions\UpdateEventAction;
use App\Domain\Admin\Event\Models\Event;
use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Event\ViewModels\ArchiveViewModel;
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
        $events = new IndexViewModel($this->event->getAll());
        $archived_events = new ArchiveViewModel($this->event->getAllArchived());

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('admin_event_title'),
            'events' => $events->table(),
            'archived_events' => $archived_events->table(),
        ]);
    }

    public function create(): DomainView
    {
        return new DomainView($this->baseViewPath . 'edit', [
            'title' => Translation::get('admin_create_event_title')
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateEventAction();
        if (array_key_exists('save-and-publish', $_POST)) {
            $create = new SaveAndPublishEventAction();
        }

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

        return new DomainView($this->baseViewPath . 'edit', [
            'title' => sprintf(
                Translation::get('admin_edit_event_title'),
                $eventRepository->getTitle()
            ),
            'event' => $event->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateEventAction();
        if (array_key_exists('save-and-publish', $_POST)) {
            $update = new SaveAndPublishEventAction();
        }

        if ($update->execute()) {
            return new Redirect($this->redirectSame . $this->event->getId());
        }

        return $this->edit();
    }

    public function publish(): Redirect
    {
        $publish = new PublishEventAction();
        $publish->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function unPublish(): Redirect
    {
        $unPublish = new UnPublishEventAction();
        $unPublish->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function removeThumbnail(): Redirect
    {
        $removeThumbnail = new RemoveEventThumbnailAction();
        $removeThumbnail->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function removeBanner(): Redirect
    {
        $removeBanner = new RemoveEventBannerAction();
        $removeBanner->execute();

        return new Redirect($this->redirectSame . $this->event->getId());
    }

    public function archive(): Redirect
    {
        $archive = new ArchiveEventAction();
        $archive->execute();

        return new Redirect($this->redirectBack);
    }

    public function activate(): Redirect
    {
        $activate = new ActivateEventAction();
        $activate->execute();

        return new Redirect($this->redirectBack);
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteEventAction();
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
