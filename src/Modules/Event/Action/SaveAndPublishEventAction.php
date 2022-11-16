<?php

namespace Modules\Event\Action;

/**
 * Provides an action for saving and un-publishing events.
 *
 * @package Modules\Event\Action
 */
final class SaveAndPublishEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPublished(TRUE);

    return parent::handle();
  }

}
