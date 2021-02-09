<?php

namespace Domain\Admin\Event\Controllers;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Domain\Admin\Event\Actions\ActivateEventAction;
use Domain\Admin\Event\Actions\ArchiveEventAction;
use Domain\Admin\Event\Actions\CreateEventAction;
use Domain\Admin\Event\Actions\DeleteEventAction;
use Domain\Admin\Event\Actions\PublishEventAction;
use Domain\Admin\Event\Actions\RemoveEventBannerAction;
use Domain\Admin\Event\Actions\RemoveEventThumbnailAction;
use Domain\Admin\Event\Actions\SaveAndPublishEventAction;
use Domain\Admin\Event\Actions\UnPublishEventAction;
use Domain\Admin\Event\Actions\UpdateEventAction;
use Domain\Admin\Event\Models\Event;
use Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Event\ViewModels\ArchivedEventTable;
use Domain\Admin\Event\ViewModels\EditViewModel;
use Domain\Admin\Event\ViewModels\EventTable;
use Components\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 * Provides a class for event actions.
 *
 * @package Domain\Admin\Event\Controllers
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class EventController extends AdminControllerBase {
  private Event $event;

  private string $redirectBack = '/admin/content/events';
  private string $redirectSame = '/admin/content/events/event/edit/';

  /**
   * EventController constructor.
   */
  public function __construct() {
    parent::__construct('Admin/Event/Views/');

    $this->event = new Event();
  }

  /**
   *
   */
  public function index(): ViewInterface {
    $eventTable = new EventTable(
          $this->event->getAll()
      );
    $archivedEventTable = new ArchivedEventTable(
          $this->event->getAllArchived()
      );

    return $this->view('index', [
      'title' => TranslationOld::get('admin_event_title'),
      'events' => $eventTable->get(),
      'archived_events' => $archivedEventTable->get('archive-table'),
    ]);
  }

  /**
   *
   */
  public function create(): ViewInterface {
    return $this->view('edit', [
      'title' => TranslationOld::get('admin_create_event_title'),
    ]);
  }

  /**
   * @return \Src\Core|\Components\View\ViewInterface
   */
  public function store() {
    $create = new CreateEventAction();
    if (array_key_exists('save-and-publish', $_POST)) {
      $create = new SaveAndPublishEventAction();
    }

    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   *
   */
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

  /**
   * @return \Src\Core|\Components\View\ViewInterface
   */
  public function update() {
    $update = new UpdateEventAction();
    if (array_key_exists('save-and-publish', $_POST)) {
      $update = new SaveAndPublishEventAction();
    }

    if ($update->execute()) {
      return new Redirect($this->redirectSame . $this->event->getId());
    }

    return $this->edit();
  }

  /**
   *
   */
  public function publish(): Redirect {
    $publish = new PublishEventAction();
    $publish->execute();

    return new Redirect($this->redirectSame . $this->event->getId());
  }

  /**
   *
   */
  public function unPublish(): Redirect {
    $unPublish = new UnPublishEventAction();
    $unPublish->execute();

    return new Redirect($this->redirectSame . $this->event->getId());
  }

  /**
   *
   */
  public function removeThumbnail(): Redirect {
    $removeThumbnail = new RemoveEventThumbnailAction();
    $removeThumbnail->execute();

    return new Redirect($this->redirectSame . $this->event->getId());
  }

  /**
   *
   */
  public function removeBanner(): Redirect {
    $removeBanner = new RemoveEventBannerAction();
    $removeBanner->execute();

    return new Redirect($this->redirectSame . $this->event->getId());
  }

  /**
   *
   */
  public function archive(): Redirect {
    $archive = new ArchiveEventAction();
    $archive->execute();

    return new Redirect($this->redirectBack);
  }

  /**
   *
   */
  public function activate(): Redirect {
    $activate = new ActivateEventAction();
    $activate->execute();

    return new Redirect($this->redirectBack);
  }

  /**
   *
   */
  public function destroy(): Redirect {
    $delete = new DeleteEventAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
