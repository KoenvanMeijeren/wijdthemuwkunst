<?php

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Modules\User\Entity\Account;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a base class for Account actions.
 *
 * @package Modules\User\Actions
 */
abstract class AccountActionBase extends EntityFormActionBase {

  /**
   * The Account entity.
   *
   * @var \Modules\User\Entity\AccountInterface|null
   */
  protected ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Account::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntitySaveStatus::SAVED_NEW:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('admin_create_account_successful_message'), $this->entity->getName())
        );

        return TRUE;

      case EntitySaveStatus::SAVED_UPDATED:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('admin_edited_account_successful_message'), $this->entity->getName())
        );

        return TRUE;

      default:
        $this->session()->flash(State::FAILED->value,
          sprintf(TranslationOld::get('admin_create_account_unsuccessful_message'), $this->entity->getName())
        );

        return FALSE;
    }
  }

}
