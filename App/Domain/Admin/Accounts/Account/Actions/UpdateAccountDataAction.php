<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\User\Models\User;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

final class UpdateAccountDataAction extends FormAction
{
    private Account $account;
    private User $user;
    private Session $session;

    protected string $name;
    protected int $rights;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->user = new User();
        $this->session = new Session();
        $request = new Request();

        $this->name = $request->post('name');
        $this->rights = (int) $request->post('rights');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getId(), [
            'account_name' => $this->name,
            'account_rights' => (string) $this->rights,
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
    protected function authorize(): bool
    {
        if ($this->rights !== $this->user->getRights()
            && $this->account->getId() === $this->user->getId()
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_edit_own_account_rights_message')
            );

            return false;
        }

        return parent::authorize();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->name, 'Naam')
            ->isRequired();

        $validator->input((string)$this->rights, 'Rechten')
            ->isRequired()
            ->isBetweenRange(User::ADMIN, User::DEVELOPER);

        return $validator->handleFormValidation();
    }
}
