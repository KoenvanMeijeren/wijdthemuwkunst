<?php
declare(strict_types=1);

namespace Modules\Contact\Actions;

use Components\Translation\TranslationOld;
use Modules\Contact\Entity\Contact;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\Entity\Status\EntitySaveStatus;

/**
 * Provides a base class for contact form actions.
 *
 * @package Modules\Contact\Actions
 */
abstract class BaseContactAction extends EntityFormActionBase {

  /**
   * The contact form entity.
   *
   * @var \Modules\Contact\Entity\ContactInterface|null
   */
  protected readonly ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Contact::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    return match ($status) {
      EntitySaveStatus::SAVED_NEW, EntitySaveStatus::SAVED_UPDATED => TRUE,
      default => FALSE,
    };
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('name', TranslationOld::get('name'))->isRequired();
    $this->validator->input('email', TranslationOld::get('email'))->isRequired()->isEmail();
    $this->validator->input('message', TranslationOld::get('message'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
