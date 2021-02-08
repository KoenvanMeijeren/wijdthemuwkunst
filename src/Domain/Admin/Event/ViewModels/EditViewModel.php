<?php

namespace Domain\Admin\Event\ViewModels;

use Components\ComponentsTrait;
use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use stdClass;
use System\StateInterface;

/**
 *
 */
final class EditViewModel {

  use ComponentsTrait;

  private ?stdClass $event;

  /**
   *
   */
  public function __construct(?stdClass $event) {
    $this->event = $event;
  }

  public function get() {
    if ($this->event === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('admin_event_cannot_be_visited')
        );

      return new Redirect('/admin/content/events');
    }

    return $this->event;
  }

}
