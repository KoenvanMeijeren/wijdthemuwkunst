<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\ViewModels;

use Src\Response\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use stdClass;

/**
 *
 */
final class EditViewModel {
  private ?stdClass $account;
  private Session $session;

  /**
   *
   */
  public function __construct(?stdClass $account) {
    $this->account = $account;
    $this->session = new Session();
  }

  /**
   * @return \Src\Response\Redirect|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->account === NULL) {
      $this->session->flash(
            State::FAILED,
            Translation::get('admin_account_cannot_be_visited')
        );

      return new Redirect('/admin/account');
    }

    return $this->account;
  }

}
