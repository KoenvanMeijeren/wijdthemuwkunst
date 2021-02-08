<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\ViewModels;

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

  /**
   *
   */
  public function __construct(private ?stdClass $account) {
    $this->account = $account;
  }

  /**
   * @return \Src\Core|object
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->account === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('admin_account_cannot_be_visited')
        );

      return new Redirect('/admin/account');
    }

    return $this->account;
  }

}
