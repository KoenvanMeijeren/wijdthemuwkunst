<?php


namespace App\Domain\Admin\Text\Actions;


use Domain\Admin\Accounts\User\Models\User;
use Src\State\State;
use Src\Translation\Translation;

final class DeleteTextAction extends BaseTextAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->text->delete($this->text->getId());

        if ($this->text->find($this->text->getId()) === null) {
            $this->session->flash(State::SUCCESSFUL,
                sprintf(
                    Translation::get('text_successful_deleted'),
                    $this->textRepository->getKey()
                )
            );

            return true;
        }

        $this->session->flash(State::SUCCESSFUL,
            sprintf(
                Translation::get('text_unsuccessful_deleted'),
                $this->textRepository->getKey()
            )
        );

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        $user = new User();
        if ($user->getRights() !== User::DEVELOPER) {
            $this->session->flash(
                State::FAILED,
                Translation::get('text_destroy_not_allowed')
            );

            return false;
        }

        return parent::authorize();
    }

    protected function validate(): bool
    {
        return true;
    }
}
