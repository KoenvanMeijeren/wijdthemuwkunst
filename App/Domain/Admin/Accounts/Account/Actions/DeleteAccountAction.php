<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\User\Models\User;
use Src\Action\Action;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

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
