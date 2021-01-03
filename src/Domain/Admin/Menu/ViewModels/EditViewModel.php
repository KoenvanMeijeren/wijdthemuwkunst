<?php

namespace Domain\Admin\Menu\ViewModels;

use Components\Header\Redirect;
use System\StateInterface;
use Src\Session\Session;
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
            StateInterface::FAILED,
            Translation::get('menu_item_does_not_exists')
        );

      return new Redirect('/admin/structure/menu');
    }

    return $this->menuItem;
  }

}
