<?php
declare(strict_types=1);


namespace App\Domain\Contact\Actions;

use App\Src\Mail\Mail;
use Domain\Admin\Settings\Models\Setting;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Security\Recaptcha;
use Src\Validate\form\FormValidator;

final class ContactAction extends FormAction
{
    private string $baseViewPath = 'Contact/Views';

    private string $name;
    private string $email;
    private string $message;

    public function __construct()
    {
        $request = new Request();

        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->message = $request->post('message');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $mail = new Mail();
        $setting = new Setting();

        $mail->addAddress(
            $setting->get('bedrijf_email'),
            $setting->get('bedrijf_naam')
        );

        $mail->setSubject($setting->get('contactformulier_onderwerp'));

        $mail->setBody(
            $this->baseViewPath,
            'contact',
            'plain-text-contact',
            [
                'company_name' => $setting->get('bedrijf_naam'),
                'copyright' => $setting->get('copyright_tekst'),
                'message' => $this->message,
                'email' => $this->email,
                'name' => $this->name,
            ]
        );

        return $mail->send();
    }

    protected function authorize(): bool
    {
        $recaptcha = new Recaptcha();

        if (!$recaptcha->validate()) {
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

        $setting = new Setting();

        $validator->input($setting->get('bedrijf_email'), 'Bedrijfsemail')
            ->settingIsRequired()
            ->isEmail();

        $validator->input($setting->get('bedrijf_naam'), 'Bedrijfsnaam')
            ->settingIsRequired();

        $validator->input($this->name, 'Naam')->isRequired();
        $validator->input($this->email, 'Email')
            ->isRequired()
            ->isEmail();
        $validator->input($this->message, 'Bericht')->isRequired();

        return $validator->handleFormValidation();
    }
}
