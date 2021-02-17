<?php

namespace Modules\Contact\Actions;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;

/**
 *
 */
final class SaveContactMessageAction extends BaseContactAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setName($this->request()->post('name'));
    $this->entity->setEmail($this->request()->post('email'));
    $this->entity->setMessage($this->request()->post('message'));
    $this->entity->setCreatedAt(new DateTime(new Chronos()));

    return $this->saveEntity();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return TRUE;
  }

}
