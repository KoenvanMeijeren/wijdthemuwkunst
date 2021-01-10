<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\ViewModels;

use Components\Header\Redirect;
use Src\Session\Session;
use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class EditViewModel {
  private ?object $setting;
  private Session $session;

  /**
   *
   */
  public function __construct(?object $setting) {
    $this->setting = $setting;
    $this->session() = new Session();
  }

  /**
   * @return \Src\Core|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->setting === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            Translation::get('setting_does_not_exists')
        );

      return new Redirect('/admin/configuration/settings');
    }

    return $this->setting;
  }

}
