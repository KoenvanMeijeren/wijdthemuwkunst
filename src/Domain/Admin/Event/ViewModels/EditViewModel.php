<?php

namespace Domain\Admin\Event\ViewModels;

use Components\Translation\TranslationOld;
use Src\Core\Redirect;
use Src\Core\StateInterface;
use Src\Session\Session;
use stdClass;

/**
 *
 */
final class EditViewModel {
  private ?stdClass $event;
  private Session $session;

  /**
   *
   */
  public function __construct(?stdClass $event) {
    $this->event = $event;
    $this->session() = new Session();
  }

  /**
   * @return \Src\Core|object
   * @throws \Components\Exceptions\Basic\InvalidKeyException
   */
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
