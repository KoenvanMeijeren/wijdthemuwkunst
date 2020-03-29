<?php


namespace App\Domain\Admin\ContactForm\Actions;

final class SaveContactFormMessageAction extends BaseContactFormAction
{

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->contactForm->create($this->attributes);

        return true;
    }

    protected function authorize(): bool
    {
        return true;
    }
}
