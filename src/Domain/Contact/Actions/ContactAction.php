<?php

declare(strict_types=1);


namespace Domain\Contact\Actions;

use Modules\ContactForm\Actions\BaseContactFormAction;
use Domain\Admin\Settings\Models\Setting;
use Components\Security\Recaptcha;
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
   * {@inheritDoc}
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $mail = new Mail($this->setting('bedrijf_naam'));
    $mail->addAddress($this->setting('bedrijf_email'), $this->setting('bedrijf_naam'));
    $mail->setSubject($this->setting('contactformulier_onderwerp'));
    $mail->setBody($this->baseViewPath, 'contact', 'plain-text-contact', [
      'company_name' => $this->setting('bedrijf_naam'),
      'copyright' => $this->setting('copyright_tekst'),
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
    $this->validator->input($this->setting('bedrijf_email'), TranslationOld::get('company_email'))
      ->settingIsRequired()
      ->isEmail();

    $this->validator->input($this->setting('bedrijf_naam'), TranslationOld::get('company_name'))
      ->settingIsRequired();

    return parent::validate();
  }

}
