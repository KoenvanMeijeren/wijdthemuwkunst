<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Settings\Models\Setting;
use Domain\Admin\Settings\Repositories\SettingRepository;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

abstract class BaseSettingAction extends FormAction
{
    protected Setting $setting;
    protected SettingRepository $settingRepository;
    protected Session $session;
    protected FormValidator $validator;

    protected string $key;
    protected string $value;

    public function __construct()
    {
        $this->setting = new Setting();
        $this->settingRepository = new SettingRepository(
            $this->setting->find($this->setting->getId())
        );
        $this->session = new Session();
        $this->validator = new FormValidator();
        $request = new Request();

        $key = $request->post(
            'setting_key',
            $this->settingRepository->getKey()
        );

        $slug = new Slug();
        $this->key = str_replace('-', '_', $slug->parse($key));
        $this->value = $request->post('setting_value');
    }

    protected function authorize(): bool
    {
        $user = new User();
        if ($this->key !== $this->settingRepository->getKey()
            && $user->getRights() !== User::DEVELOPER
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_editing_key_not_allowed')
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
        $this->validator->input($this->key, 'Sleutel')->isRequired();
        $this->validator->input($this->value, 'Waarde')->isRequired();

        if ($this->key !== $this->settingRepository->getKey()) {
            $this->validator->input($this->key)
                ->isUnique(
                    $this->setting->getByKey($this->key),
                    sprintf(
                        Translation::get('setting_already_exists'),
                        $this->key
                    )
                );
        }

        return $this->validator->handleFormValidation();
    }
}
