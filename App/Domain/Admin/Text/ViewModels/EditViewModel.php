<?php

namespace Domain\Admin\Text\ViewModels;

use Src\Core\Redirect;
use Src\Core\StateInterface;
use Src\Session\Session;
use Src\Translation\Translation;

/**
 *
 */
final class EditViewModel {
  private ?object $text;
  private Session $session;

  /**
   *
   */
  public function __construct(?object $text) {
    $this->text = $text;
    $this->session = new Session();
  }

  /**
   * @return \Src\Core|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->text === NULL) {
      $this->session->flash(
            StateInterface::FAILED,
            Translation::get('text_does_not_exists')
        );

      return new Redirect('/admin/configuration/texts');
    }

    return $this->text;
  }

}
