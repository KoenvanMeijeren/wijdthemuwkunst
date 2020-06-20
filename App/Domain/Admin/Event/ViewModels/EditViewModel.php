<?php

namespace App\Domain\Admin\Event\ViewModels;

use Src\Response\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
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
    $this->session = new Session();
  }

  /**
   * @return \Src\Response\Redirect|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->event === NULL) {
      $this->session->flash(
            State::FAILED,
            Translation::get('admin_event_cannot_be_visited')
        );

      return new Redirect('/admin/content/events');
    }

    return $this->event;
  }

}
