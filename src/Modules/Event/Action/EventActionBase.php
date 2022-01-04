<?php

namespace Modules\Event\Action;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;
use Components\Translation\TranslationOld;
use Modules\Event\Entity\Event;
use Modules\File\Actions\SaveFileAction;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a base for event actions.
 *
 * @package Modules\Event\Action
 */
abstract class EventActionBase extends EntityFormActionBase {

  /**
   * The entity.
   *
   * @var \Modules\Event\Entity\EventInterface|null
   */
  protected ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Event::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $date = $this->request()->post('date');
    $time = $this->request()->post('time');
    $datetime = new Chronos($date . $time);
    $datetime = new DateTime($datetime);

    $this->entity->setTitle($this->request()->post('title'));
    $this->entity->setSlug($this->entity->getTitle());
    $this->entity->setLocation($this->request()->post('location'));
    $this->entity->setDate($datetime);
    $this->entity->setContent($this->request()->post('content'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntitySaveStatus::SAVED_NEW:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('event_successfully_created'), $this->entity->getTitle())
        );

        return TRUE;

      case EntitySaveStatus::SAVED_UPDATED:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('event_successfully_updated'), $this->entity->getTitle())
        );

        return TRUE;

      default:
        $this->session()->flash(State::FAILED->value,
          sprintf(TranslationOld::get('event_unsuccessfully_updated'), $this->entity->getTitle())
        );

        return FALSE;
    }
  }

  /**
   * Get the location of the file, save it and return the id.
   *
   * @return int
   *   The id of the file.
   */
  protected function getFileId(string $fileLocation): int {
    if ($fileLocation === '') {
      return 0;
    }

    $fileLocation = json_decode(html_entities_decode($fileLocation), TRUE, 512, JSON_THROW_ON_ERROR);

    if (isset($fileLocation['location'])) {
      return 0;
    }

    $saveFile = new SaveFileAction($fileLocation['location']);
    $saveFile->execute();

    return $saveFile->getEntityId();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('title', 'Concert titel')->isRequired();
    $this->validator->input('content', 'Concert content')->isRequired();
    $this->validator->input('date', 'Concert datum en tijdstip')->isDateTime();
    $this->validator->input('location', 'Concert locatie')->isRequired();

    if ($this->request()->post('title') !== $this->entity->getTitle()) {
      $this->validator->input('slug', TranslationOld::get('slug'))
        ->isRequired()
        ->isUnique(
          $this->entityManager->loadByAttributes([
            'slug_name' => (string) $this->entity->getSlug()
          ]),
          sprintf(TranslationOld::get('event_already_exists'), $this->entity->getSlug())
        );
    }

    return $this->validator->handleFormValidation();
  }

}
