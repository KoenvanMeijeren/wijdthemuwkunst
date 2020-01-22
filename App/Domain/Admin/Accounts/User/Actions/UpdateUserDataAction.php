<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\User\Actions;

use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

final class UpdateUserDataAction extends FormAction
{
    private Session $session;
    private User $user;

    private string $name;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();
        $this->user = $user;

        $this->name = $request->post('name');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->user->update($this->user->getId(), [
            'account_name' => $this->name
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

        $validator->input($this->name, 'Naam')
            ->isRequired();

        return $validator->handleFormValidation();
    }
}
