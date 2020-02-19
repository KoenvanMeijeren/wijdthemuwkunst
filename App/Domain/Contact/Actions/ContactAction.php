<?php
declare(strict_types=1);


namespace App\Domain\Contact\Actions;


use App\Src\Mail\Mail;
use Domain\Admin\Settings\Models\Setting;
use Src\Action\FormAction;
use Src\Core\Request;
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

        $mail->setFrom($this->email, $this->name);
        $mail->addAddress($setting->get('bedrijf_email'),
            $setting->get('bedrijf_naam'));
        $mail->setSubject($setting->get('contactformulier_onderwerp'));

        $mail->setBody($this->baseViewPath,
            'contact',
            'plain-text-contact', [
                'company_name' => $setting->get('bedrijf_naam'),
                'copyright' => $setting->get('copyright_tekst'),
                'message' => $this->message,
            ]);

        return $mail->send();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->name, 'Naam')->isRequired();
        $validator->input($this->email, 'Email')->isRequired();
        $validator->input($this->message, 'Bericht')->isRequired();

        return $validator->handleFormValidation();
    }
}
