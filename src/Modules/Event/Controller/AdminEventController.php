<?php

namespace Modules\Event\Controller;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Event\Entity\ArchivedEventTable;
use Modules\Event\Entity\Event;
use Modules\Event\Entity\EventTable;
use System\Entity\EntityControllerBase;

/**
 * Provides a class for event actions.
 *
 * @package Domain\Admin\Event\Controllers
 */
final class AdminEventController extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  private string $redirectBack = '/admin/content/events';

  /**
   * The path to redirect if we do not want to go back.
   *
   * @var string
   */
  private string $redirectSame = '/admin/content/events/event/edit/';

  /**
   * EventController constructor.
   */
  public function __construct() {
    parent::__construct(entityClass: Event::class, baseViewPath: 'Event/Views/admin.');
  }

  public function index(): ViewInterface {
    /** @var \Modules\Event\Entity\EventRepositoryInterface $repository */
    $repository = $this->repository;

    $eventTable = new EventTable($repository->all());
    $archivedEventTable = new ArchivedEventTable($repository->all(archived: TRUE));

    return $this->view('index', [
      'title' => TranslationOld::get('admin_event_title'),
      'events' => $eventTable->get(),
      'archived_events' => $archivedEventTable->get('archive-table'),
    ]);
  }

  public function create(): ViewInterface {
    return $this->view('edit', [
      'title' => TranslationOld::get('admin_create_event_title'),
    ]);
  }

  public function store(): ViewInterface|Redirect {
    $create = new CreateEventAction();
    if ($this->request()->post('save-and-publish') !== '') {
      $create = new SaveAndPublishEventAction();
    }

    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  public function edit(): ViewInterface {
    $event = new EditViewModel(
          $this->event->find($this->event->getId())
      );
    $eventRepository = new EventRepository($event->get());

    return $this->view('edit', [
      'title' => sprintf(
              TranslationOld::get('admin_edit_event_title'),
              $eventRepository->getTitle()
      ),
      'event' => $event->get(),
    ]);
  }

  public function update(): ViewInterface|Redirect {
    $update = new UpdateEventAction();
    if ($this->request()->post('save-and-publish') !== '') {
      $update = new SaveAndPublishEventAction();
    }

    if ($update->execute()) {
      return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
    }

    return $this->edit();
  }

  public function publish(): Redirect {
    $publish = new PublishEventAction();
    $publish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function unPublish(): Redirect {
    $unPublish = new UnPublishEventAction();
    $unPublish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function removeThumbnail(): Redirect {
    $removeThumbnail = new RemoveEventThumbnailAction();
    $removeThumbnail->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function removeBanner(): Redirect {
    $removeBanner = new RemoveEventBannerAction();
    $removeBanner->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function archive(): Redirect {
    $archive = new ArchiveEventAction();
    $archive->execute();

    return new Redirect($this->redirectBack);
  }

  public function activate(): Redirect {
    $activate = new ActivateEventAction();
    $activate->execute();

    return new Redirect($this->redirectBack);
  }

  public function destroy(): Redirect {
    $delete = new DeleteEventAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
