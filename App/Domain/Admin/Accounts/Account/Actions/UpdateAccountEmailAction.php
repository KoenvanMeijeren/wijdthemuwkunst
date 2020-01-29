<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Domain\Admin\Accounts\Account\Models\Account;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

final class UpdateAccountEmailAction extends FormAction
{
    private Account $account;
    private Session $session;

    protected string $email;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $request = new Request();

        $this->email = $request->post('email');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getId(), [
            'account_email' => $this->email,
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

        $validator->input($this->email, 'Email')
            ->isEmail()
            ->isUnique(
                $this->account->getByEmail($this->email),
                sprintf(
                    Translation::get('admin_email_already_exists_message'),
                    $this->email
                )
            );

        return $validator->handleFormValidation();
    }
}
