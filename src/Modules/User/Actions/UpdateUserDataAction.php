<?php
declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Modules\User\CurrentUser;
use System\Entity\EntityInterface;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateUserDataAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function getEntity(): ?EntityInterface {
    return (new CurrentUser())->get();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setName($this->request()->post('name'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('name', TranslationOld::get('name'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
