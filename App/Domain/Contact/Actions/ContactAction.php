<?php

declare(strict_types=1);


namespace Domain\Contact\Actions;

use Domain\Admin\ContactForm\Actions\BaseContactFormAction;
use Domain\Admin\Settings\Models\Setting;
use Src\Security\Recaptcha;
use Src\Translation\Translation;
use System\Mail\Mail;

/**
 * Provides a contact action.
 *
 * @package Domain\Contact\Actions
 */
final class ContactAction extends BaseContactFormAction {

  /**
   * The base view path of the mail templates.
   *
   * @var string
   */
  protected string $baseViewPath = 'Contact/Views';

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
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

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    $recaptcha = new Recaptcha();
    if (!$recaptcha->validate()) {
      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $setting = new Setting();

    $this->validator->input($setting->get('bedrijf_email'), Translation::get('company_email'))
      ->settingIsRequired()
      ->isEmail();

    $this->validator->input($setting->get('bedrijf_naam'), Translation::get('company_name'))
      ->settingIsRequired();

    return parent::validate();
  }

}
