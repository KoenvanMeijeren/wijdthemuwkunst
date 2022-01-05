<?php
declare(strict_types=1);

namespace Modules\Authentication\Actions;

use Components\Actions\FormAction;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Modules\Authentication\Support\IDEncryption;
use Modules\User\Entity\Account;
use Modules\User\Entity\AccountInterface;
use System\State;

/**
 * Provides an action for logging an user in.
 *
 * @package Modules\Authentication\Actions
 */
final class UserLogInAction extends FormAction {

  /**
   * The account entity.
   *
   * @var \Modules\User\Entity\AccountInterface
   */
  protected readonly AccountInterface $entity;

  /**
   * The maximum number of login attempts.
   *
   * @var int
   */
  protected readonly int $maximumLoginAttempts;

  /**
   * UserLogInAction constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->maximumLoginAttempts = (int) $this->request()->env('login_attempts');
    $entity = $this->user();
    if ($email = $this->request()->post('email')) {
      $entity = $this->getEntityManager()
        ->getStorage(Account::class)
        ->getRepository()
        ->firstByAttributes([
          'account_email' => $email,
        ]);
    }

    $this->entity = $entity;
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    if (password_verify($this->request()->post('password'), $this->entity->getPassword())) {
      $this->session()->unset('userID');

      $idEncryption = new IDEncryption();
      $token = $idEncryption->generateToken();

      $this->session()->save('userID', $idEncryption->encrypt($this->entity->id(), $token));

      // Always executed.
      $this->entity->setLoginToken($token);
      $this->rehashPassword();
      $this->resetFailedLogInAttempts();
      $this->entity->save();

      $this->session()->flash(State::SUCCESSFUL->value, TranslationOld::get('login_successful_message'));

      return TRUE;
    }

    // Only executed when the user is an admin.
    $this->addFailedLogInAttempt();
    $this->blockAccount();

    $this->entity->save();

    $this->session()->flash(State::FAILED->value, TranslationOld::get('login_failed_message'));

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->entity->isBlocked()) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('login_failed_blocked_account_message'));

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('email', TranslationOld::get('email'))
      ->isRequired()
      ->isEmail();

    $this->validator->input('password', TranslationOld::get('password'))
      ->isRequired();

    return $this->validator->handleFormValidation();
  }

  /**
   * {@inheritDoc}
   */
  private function rehashPassword(): void {
    if (password_needs_rehash($this->entity->getPassword(), AccountInterface::PASSWORD_HASH_METHOD)) {
      $this->entity->setPassword($this->entity->getPassword());
    }
  }

  /**
   * {@inheritDoc}
   */
  private function resetFailedLogInAttempts(): void {
    if ($this->entity->getRouteRights()->hasAccess(RouteRights::ADMIN)) {
      return;
    }

    $this->entity->setFailedLogins(0);
  }

  /**
   * {@inheritDoc}
   */
  private function addFailedLogInAttempt(): void {
    if ($this->entity->getRouteRights()->hasAccess(RouteRights::ADMIN)) {
      return;
    }

    $current = $this->entity->getFailedLogins();
    $this->entity->setFailedLogins($current + 1);
  }

  /**
   * If the number of failed log in attempts is higher than
   * the maximum number of failed log in attempts, block the account.
   */
  private function blockAccount(): void {
    if ($this->entity->getRouteRights()->hasAccess(RouteRights::ADMIN)
      || $this->entity->getFailedLogins() < $this->maximumLoginAttempts) {
      return;
    }

    $this->entity->setBlocked(TRUE);
  }

}
