<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use Modules\Event\Entity\Event;
use Modules\File\Actions\SaveFileAction;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\StateInterface;

/**
 * Provides a base for event actions.
 *
 * @package Modules\Event\Action
 */
abstract class EventActionBase extends EntityFormActionBase {

  /**
   * The entity.
   *
   * @var \Modules\Event\Entity\EventInterface
   */
  protected EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Event::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('event_successfully_created'), $this->entity->getTitle())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('event_successfully_updated'), $this->entity->getTitle())
        );

        return TRUE;

      default:
        $this->session()->flash(StateInterface::FAILED,
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
   * @inheritDoc
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
