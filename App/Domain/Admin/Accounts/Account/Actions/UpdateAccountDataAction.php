<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Actions\BaseAccountAction;
use Domain\Admin\Accounts\User\Models\User;
use Src\State\State;
use Src\Translation\Translation;

final class UpdateAccountDataAction extends BaseAccountAction
{
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
        $this->validator->input($this->name, 'Naam')
            ->isRequired();

        $this->validator->input((string)$this->rights, 'Rechten')
            ->isRequired()
            ->isBetweenRange(User::ADMIN, User::DEVELOPER);

        return $this->validator->handleFormValidation();
    }
}
