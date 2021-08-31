<?php

namespace Modules\Event\Action;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;

/**
 * Provides an action for creating events.
 *
 * @package Modules\Event\Action
 */
class CreateEventAction extends EventActionBase {

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

}
