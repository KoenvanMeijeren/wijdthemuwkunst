<?php
declare(strict_types=1);

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\Entity\EntityInterface;
use System\State;

/**
 * Provides an action for activating events.
 *
 * @package Modules\Event\Action
 */
final class ActivateEventAction extends EventActionBase {

  /**
   * {@inheritdoc}
   */
  protected function getEntity(): ?EntityInterface {
    $entity = $this->storage->create();
    if ($id = $this->request()->getRouteParameter()) {
      $entity = $this->storage->getRepository()->loadById((int) $id, archived: TRUE);
    }

    return $entity;
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setArchived(FALSE);
    $this->entity->save();

    $this->session()->flash(
      State::SUCCESSFUL->value,
      sprintf(
        TranslationOld::get('event_successfully_activated'),
        $this->entity->getTitle()
      )
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
