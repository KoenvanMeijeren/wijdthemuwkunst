<?php

declare(strict_types=1);

namespace Domain\Admin\Event\Actions;

use Cake\Chronos\Chronos;
use Components\Actions\FormAction;
use Components\Translation\TranslationOld;
use Domain\Admin\Event\Models\Event;
use Domain\Admin\Event\Repositories\EventRepository;
use Modules\File\Actions\SaveFileAction;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Pages\Repositories\SlugRepository;
use Components\Validate\FormValidator;

/**
 *
 */
abstract class BaseEventAction extends FormAction {
  protected Slug $slug;
  protected Event $event;
  protected EventRepository $eventRepository;
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
    $this->validator = new FormValidator();

    $this->thumbnailID = $this->getFileId($this->request()->post('thumbnail'));
    $this->bannerID = $this->getFileId($this->request()->post('banner'));
    $this->title = $this->request()->post('title');
    $this->url = $this->slug->parse($this->title);
    $this->content = $this->request()->post('content');
    $this->date = $this->request()->post('date');
    $this->time = $this->request()->post('time');
    $datetime = new Chronos($this->date . $this->time);
    $this->datetime = $datetime->toDateTimeString();
    $this->location = $this->request()->post('location');

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
          html_entities_decode($fileLocation),
          TRUE,
          512,
          JSON_THROW_ON_ERROR
      );

    if (!array_key_exists('location', $fileLocation)) {
      return 0;
    }

    $saveFile = new SaveFileAction($fileLocation['location']);
    $saveFile->execute();

    return $saveFile->getEntityId();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    if ($this->eventRepository->getId() === 0) {
      $this->validator->input((string) $this->thumbnailID, 'Concert thumbnail')->intIsRequired();
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
                    TranslationOld::get('event_already_exists'),
                    $this->url
                )
            );
    }

    return $this->validator->handleFormValidation();
  }

}
