<?php
declare(strict_types=1);


namespace Domain\Admin\Authentication\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\Action\Action;
use Src\Session\Builder;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

final class LogUserOutAction extends Action
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user =  $user;
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $builder = new Builder();
        $builder->destroy();
        $builder->startSession();
        $builder->setSessionSecurity();

        $session = new Session();
        $session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_logout_message')
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        return $this->user->isLoggedIn();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
