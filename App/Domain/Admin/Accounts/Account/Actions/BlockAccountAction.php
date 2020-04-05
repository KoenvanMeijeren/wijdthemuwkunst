<?php
declare(strict_types=1);

namespace Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Actions\BaseAccountAction;
use Src\State\State;
use Src\Translation\Translation;

final class BlockAccountAction extends BaseAccountAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getId(), [
            'account_is_blocked' => '1'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_account_successful_blocked_message')
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if ($this->user->getId() === $this->account->getId()) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_block_own_account_message')
            );
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
