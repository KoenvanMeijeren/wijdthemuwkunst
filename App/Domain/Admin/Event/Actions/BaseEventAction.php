<?php

declare(strict_types=1);

namespace App\Domain\Admin\Event\Actions;

use App\Domain\Admin\Event\Models\Event;
use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\File\Actions\SaveFileAction;
use Cake\Chronos\Chronos;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Pages\Repositories\SlugRepository;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

/**
 *
 */
abstract class BaseEventAction extends FormAction {
  protected Slug $slug;
  protected Event $event;
  protected EventRepository $eventRepository;
  protected Session $session;
  protected FormValidator $validator;

  protected int $bannerID = 0;
  protected int $thumbnailID = 0;
  protected string $title;
  protected string $url;
  protected string $content;
  protected string $datetime;
  protected string $date;
  protected string $time;
  protected string $location;

  protected array $attributes = [];

  /**
   *
   */
  public function __construct() {
    $this->slug = new Slug();
    $this->event = new Event();
    $this->eventRepository = new EventRepository(
          $this->event->find($this->event->getId())
      );
    $this->session = new Session();
    $this->validator = new FormValidator();
    $request = new Request();

    $this->thumbnailID = $this->getFileId($request->post('thumbnail'));
    $this->bannerID = $this->getFileId($request->post('banner'));
    $this->title = $request->post('title');
    $this->url = $this->slug->parse($this->title);
    $this->content = $request->post('content');
    $this->date = $request->post('date');
    $this->time = $request->post('time');
    $datetime = new Chronos($this->date . $this->time);
    $this->datetime = $datetime->toDateTimeString();
    $this->location = $request->post('location');

    $this->prepareAttributes();
  }

  /**
   * Prepare the attributes.
   */
  protected function prepareAttributes(): void {
    $this->attributes = [
      'event_slug_ID' => (string) $this->getSlugId(),
      'event_title' => $this->title,
      'event_content' => $this->content,
      'event_date' => $this->datetime,
      'event_location' => $this->location,
    ];

    if ($this->thumbnailID !== 0) {
      $this->attributes['event_thumbnail_ID'] = (string) $this->thumbnailID;
    }

    if ($this->bannerID !== 0) {
      $this->attributes['event_banner_ID'] = (string) $this->bannerID;
    }
  }

  /**
   * Get the first record matching the attributes or create it and return the id.
   */
  protected function getSlugId(): int {
    $slugRepository = new SlugRepository(
          $this->slug->firstOrCreate([
            'slug_name' => $this->url,
          ])
      );

    return $slugRepository->getId();
  }

  /**
   * Get the location of the file, save it and return the id.
   */
  protected function getFileId(string $fileLocation): int {
    if ($fileLocation === '') {
      return 0;
    }

    $fileLocation = json_decode(
          parseHtmlEntities($fileLocation),
          TRUE,
          512,
          JSON_THROW_ON_ERROR
      );

    if (!array_key_exists('location', $fileLocation)) {
      return 0;
    }

    $saveFile = new SaveFileAction($fileLocation['location']);
    $saveFile->execute();

    return $saveFile->getId();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    if ($this->eventRepository->getId() === 0) {
      $this->validator->input($this->thumbnailID, 'Concert thumbnail')->intIsRequired();
    }

    $this->validator->input($this->title, 'Concert titel')->isRequired();
    $this->validator->input($this->content, 'Concert content')->isRequired();
    $this->validator->input($this->datetime, 'Concert datum en tijdstip')->isDateTime();
    $this->validator->input($this->location, 'Concert locatie')->isRequired();

    if ($this->url !== $this->eventRepository->getSlug()) {
      $this->validator->input($this->url, 'Slug')
        ->isRequired()
        ->isUnique(
                $this->event->getBySlug($this->url),
                sprintf(
                    Translation::get('event_already_exists'),
                    $this->url
                )
            );
    }

    return $this->validator->handleFormValidation();
  }

}
