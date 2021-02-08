<?php

namespace Domain\Admin\Menu\ViewModels;

use Components\ComponentsTrait;
use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class EditViewModel {

  use ComponentsTrait;

  private ?object $menuItem;

  /**
   *
   */
  public function __construct(?object $menuItem) {
    $this->menuItem = $menuItem;
  }

  public function get() {
    if ($this->menuItem === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('menu_item_does_not_exists')
        );

      return new Redirect('/admin/structure/menu');
    }

    return $this->menuItem;
  }

}
