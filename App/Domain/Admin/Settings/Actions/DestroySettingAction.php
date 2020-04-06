<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\State\State;
use Src\Translation\Translation;

final class DestroySettingAction extends BaseSettingAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->setting->delete($this->setting->getId());

        if ($this->setting->find($this->setting->getId()) === null) {
            $this->session->flash(
                State::SUCCESSFUL,
                sprintf(
                    Translation::get('setting_successful_deleted'),
                    $this->settingRepository->getKey()
                )
            );

            return true;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('setting_unsuccessful_deleted'),
                $this->settingRepository->getKey()
            )
        );
        return false;
    }

    protected function authorize(): bool
    {
        $user = new User();
        if ($user->getRights() !== User::DEVELOPER) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_destroy_not_allowed')
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
        return true;
    }
}
