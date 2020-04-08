<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Actions\BaseAccountAction;
use Domain\Admin\Accounts\Account\Models\Account;
use Src\State\State;
use Src\Translation\Translation;

final class UpdateAccountPasswordAction extends BaseAccountAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getId(), [
            'account_password' => (string) password_hash(
                $this->password,
                Account::PASSWORD_HASH_METHOD
            ),
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_edited_account_successful_message')
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $this->validator->input($this->password, 'Wachtwoord')
            ->isRequired()
            ->passwordIsEqual($this->confirmationPassword)
            ->passwordIsNotCurrentPassword($this->accountRepository->getPassword());

        return $this->validator->handleFormValidation();
    }
}
