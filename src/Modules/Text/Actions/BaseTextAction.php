<?php
declare(strict_types=1);

namespace Modules\Text\Actions;

use Components\Translation\TranslationOld;
use Modules\Text\Entity\Text;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a base class for text actions.
 *
 * @package Domain\Admin\Text\Actions
 */
abstract class BaseTextAction extends EntityFormActionBase {

  /**
   * The text entity.
   *
   * @var \Modules\Text\Entity\TextInterface|null
   */
  protected readonly ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Text::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntitySaveStatus::SAVED_NEW:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('text_successful_created'), $this->entity->getKey())
        );

        return TRUE;

      case EntitySaveStatus::SAVED_UPDATED:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('text_successful_updated'), $this->entity->getKey())
        );

        return TRUE;

      default:
        $this->session()->flash(State::FAILED->value,
          sprintf(TranslationOld::get('text_unsuccessful_updated'), $this->entity->getKey())
        );

        return FALSE;
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('key', TranslationOld::get('key'))->isRequired();
    $this->validator->input('value', TranslationOld::get('value'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
