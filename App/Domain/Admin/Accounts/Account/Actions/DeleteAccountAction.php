<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Models\Account;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Action\Action;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class DeleteAccountAction extends Action
{
    private Account $account;
    private Session $session;
    private User $user;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $this->user = new User();
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->delete($this->account->getId());

        if ($this->account->find($this->account->getId()) === null) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_deleted_account_successful_message')
            );
            return true;
        }

        $this->session->flash(
            State::FAILED,
            Translation::get('admin_deleted_account_failed_message')
        );
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        if ($this->user->getId() === $this->account->getId()) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_delete_own_account_message')
            );
            return false;
        }

        return true;
    }
}
