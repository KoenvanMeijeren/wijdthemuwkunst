<?php

namespace Domain\Admin\Menu\ViewModels;

use Src\Core\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class EditViewModel {
  private ?object $menuItem;
  private Session $session;

  /**
   *
   */
  public function __construct(?object $menuItem) {
    $this->menuItem = $menuItem;
    $this->session = new Session();
  }

  /**
   * @return \Src\Core|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->menuItem === NULL) {
      $this->session->flash(
            State::FAILED,
            Translation::get('menu_item_does_not_exists')
        );

      return new Redirect('/admin/structure/menu');
    }

    return $this->menuItem;
  }

}
