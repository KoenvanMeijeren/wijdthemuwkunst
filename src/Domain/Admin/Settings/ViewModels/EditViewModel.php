<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\ViewModels;

use Components\ComponentsTrait;
use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class EditViewModel {

  use ComponentsTrait;

  private ?object $setting;

  /**
   *
   */
  public function __construct(?object $setting) {
    $this->setting = $setting;
  }

  /**
   * @return \Src\Core|object
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->setting === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('setting_does_not_exists')
        );

      return new Redirect('/admin/configuration/settings');
    }

    return $this->setting;
  }

}
