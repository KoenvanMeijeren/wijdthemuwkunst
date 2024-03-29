<?php
declare(strict_types=1);

namespace Modules\Event\Controller;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Event\Action\ActivateEventAction;
use Modules\Event\Action\ArchiveEventAction;
use Modules\Event\Action\CreateEventAction;
use Modules\Event\Action\DeleteEventAction;
use Modules\Event\Action\PublishEventAction;
use Modules\Event\Action\RemoveEventBannerAction;
use Modules\Event\Action\RemoveEventThumbnailAction;
use Modules\Event\Action\SaveAndPublishEventAction;
use Modules\Event\Action\UnPublishEventAction;
use Modules\Event\Action\UpdateEventAction;
use Modules\Event\Entity\ArchivedEventTable;
use Modules\Event\Entity\Event;
use Modules\Event\Entity\EventInterface;
use Modules\Event\Entity\EventTable;
use System\Entity\EntityControllerBase;
use System\State;

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

  #[RouteGet(url: 'admin/content/events', rights: RouteRights::ADMIN)]
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

  #[RouteGet(url: 'admin/content/events/event/create', rights: RouteRights::ADMIN)]
  public function create(): ViewInterface {
    return $this->view('edit', [
      'title' => TranslationOld::get('admin_create_event_title'),
    ]);
  }

  #[RoutePost(url: 'admin/content/events/event/create/store', rights: RouteRights::ADMIN)]
  public function store(): ViewInterface|Redirect {
    $create = new CreateEventAction();
    if ($this->request()->post('save-and-publish') === 'save_and_publish') {
      $create = new SaveAndPublishEventAction();
    }

    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  #[RouteGet(url: 'admin/content/events/event/edit/{slug}', rights: RouteRights::ADMIN)]
  public function edit(): ViewInterface|Redirect {
    $event = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if (!$event instanceof EventInterface) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('page_does_not_exists'));

      return new Redirect($this->redirectBack);
    }

    return $this->view('edit', [
      'title' => sprintf(TranslationOld::get('admin_edit_event_title'), $event->getTitle()),
      'event' => $event,
    ]);
  }

  #[RoutePost(url: 'admin/content/events/event/edit/{slug}/store', rights: RouteRights::ADMIN)]
  public function update(): ViewInterface|Redirect {
    $update = new UpdateEventAction();
    if ($this->request()->post('save-and-publish') === 'save_and_publish') {
      $update = new SaveAndPublishEventAction();
    }

    if ($update->execute() && !empty($this->request()->getRouteParameter())) {
      return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
    }

    return $this->edit();
  }

  #[RoutePost(url: 'admin/content/events/event/publish/{slug}', rights: RouteRights::ADMIN)]
  public function publish(): Redirect {
    $publish = new PublishEventAction();
    $publish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  #[RoutePost(url: 'admin/content/events/event/unpublish/{slug}', rights: RouteRights::ADMIN)]
  public function unPublish(): Redirect {
    $unPublish = new UnPublishEventAction();
    $unPublish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  #[RoutePost(url: 'admin/content/events/event/edit/{slug}/remove/thumbnail', rights: RouteRights::ADMIN)]
  public function removeThumbnail(): Redirect {
    $removeThumbnail = new RemoveEventThumbnailAction();
    $removeThumbnail->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  #[RoutePost(url: 'admin/content/events/event/edit/{slug}/remove/banner', rights: RouteRights::ADMIN)]
  public function removeBanner(): Redirect {
    $removeBanner = new RemoveEventBannerAction();
    $removeBanner->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  #[RoutePost(url: 'admin/content/events/event/archive/{slug}', rights: RouteRights::ADMIN)]
  public function archive(): Redirect {
    $archive = new ArchiveEventAction();
    $archive->execute();

    return new Redirect($this->redirectBack);
  }

  #[RoutePost(url: 'admin/content/events/event/activate/{slug}', rights: RouteRights::ADMIN)]
  public function activate(): Redirect {
    $activate = new ActivateEventAction();
    $activate->execute();

    return new Redirect($this->redirectBack);
  }

  #[RoutePost(url: 'admin/content/events/event/delete/{slug}', rights: RouteRights::ADMIN)]
  public function destroy(): Redirect {
    $delete = new DeleteEventAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
