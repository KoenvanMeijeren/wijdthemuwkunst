<?php
declare(strict_types=1);

namespace Modules\Setting\Actions;

use Components\Translation\TranslationOld;
use Modules\Setting\Entity\Setting;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\State;

/**
 * Provides a base class for setting actions.
 *
 * @package Modules\Setting\Actions
 */
abstract class BaseSettingAction extends EntityFormActionBase {

  /**
   * The setting entity.
   *
   * @var \Modules\Setting\Entity\SettingInterface|null
   */
  protected ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Setting::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('setting_successful_created'), $this->entity->getKey())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('setting_successful_updated'), $this->entity->getKey())
        );

        return TRUE;

      default:
        $this->session()->flash(State::FAILED->value,
          sprintf(TranslationOld::get('setting_unsuccessful_updated'), $this->entity->getKey())
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
