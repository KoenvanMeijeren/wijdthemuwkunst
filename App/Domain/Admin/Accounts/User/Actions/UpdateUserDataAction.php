<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Actions;


use App\Domain\Admin\Accounts\User\Actions\BaseUserAction;

final class UpdateUserDataAction extends BaseUserAction
{
    /**
     * @inheritDoc
     */
    protected function prepareAttributes(): void
    {
        $this->attributes = [
            'account_name' => $this->name,
        ];
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $this->validator->input($this->name, 'Naam')->isRequired();

        return $this->validator->handleFormValidation();
    }
}
