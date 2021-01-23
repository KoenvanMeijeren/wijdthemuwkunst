<?php

declare(strict_types=1);


namespace Domain\Contact\Actions;

use Domain\Admin\ContactForm\Actions\BaseContactFormAction;
use Domain\Admin\Settings\Models\Setting;
use Src\Security\Recaptcha;
use Components\Translation\TranslationOld;
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
   * The setting definition.
   *
   * @var \Domain\Admin\Settings\Models\Setting
   */
  protected Setting $setting;

  /**
   * {@inheritDoc}
   */
  public function __construct() {
    parent::__construct();

    $this->setting = new Setting();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $mail = new Mail($this->setting->get('bedrijf_naam'));
    $mail->addAddress($this->setting->get('bedrijf_email'), $this->setting->get('bedrijf_naam'));
    $mail->setSubject($this->setting->get('contactformulier_onderwerp'));
    $mail->setBody($this->baseViewPath, 'contact', 'plain-text-contact', [
      'company_name' => $this->setting->get('bedrijf_naam'),
      'copyright' => $this->setting->get('copyright_tekst'),
      'message' => $this->message,
      'email' => $this->email,
      'name' => $this->name,
    ]);

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
    $this->validator->input($this->setting->get('bedrijf_email'), TranslationOld::get('company_email'))
      ->settingIsRequired()
      ->isEmail();

    $this->validator->input($this->setting->get('bedrijf_naam'), TranslationOld::get('company_name'))
      ->settingIsRequired();

    return parent::validate();
  }

}
