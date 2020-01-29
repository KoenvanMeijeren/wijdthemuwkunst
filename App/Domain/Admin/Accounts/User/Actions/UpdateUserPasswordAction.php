<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Actions;

use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

final class UpdateUserPasswordAction extends FormAction
{
    private Session $session;
    private User $user;

    private string $currentPassword;
    private string $newPassword;
    private string $confirmationPassword;

    private AccountRepository $account;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();

        $this->user = $user;
        $this->account = new AccountRepository($user->getAccount());

        $this->currentPassword = $request->post('currentPassword');
        $this->newPassword = $request->post('newPassword');
        $this->confirmationPassword = $request->post(
            'confirmationPassword'
        );
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->user->update($this->account->getId(), [
            'account_password' =>  (string) password_hash(
                $this->newPassword,
                Account::PASSWORD_HASH_METHOD
            )
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
        $validator = new FormValidator();

        $validator->input($this->currentPassword)
            ->passwordIsVerified($this->account->getPassword());

        $validator->input($this->newPassword)
            ->isRequired()
            ->passwordIsEqual($this->confirmationPassword)
            ->passwordIsNotCurrentPassword($this->currentPassword);

        return $validator->handleFormValidation();
    }
}
