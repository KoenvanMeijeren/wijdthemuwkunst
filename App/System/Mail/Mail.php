<?php

declare(strict_types=1);


namespace App\System\Mail;

use Domain\Admin\Settings\Models\Setting;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Src\Core\Env;
use Src\Core\Request;
use System\View\MailView;

/**
 * Provides a class for sending emails.
 *
 * @package App\System\Mail
 */
final class Mail implements MailInterface {

  /**
   * The PHPMailer definition.
   *
   * @var PHPMailer
   */
  protected PHPMailer $mailer;

  /**
   * Mail constructor.
   */
  public function __construct() {
    $this->mailer = new PHPMailer(TRUE);
    $env = new Env();
    $request = new Request();

    // Set mail credentials.
    if ($env->get() === Env::PRODUCTION) {
      $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
      $this->mailer->Host = $request->env('mail_host');
      $this->mailer->SMTPAuth = TRUE;
      $this->mailer->Username = $request->env('mail_username');
      $this->mailer->Password = $request->env('mail_password');
      $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $this->mailer->Port = (int) $request->env('mail_port');
    }

    $this->mailer->isHTML(TRUE);

    $setting = new Setting();
    $this->mailer->setFrom(
          $request->env('mail_username'),
          $setting->get('bedrijf_naam')
      );

    $this->mailer->addAddress(
          $request->env('mail_username'),
          $setting->get('bedrijf_naam')
      );
  }

  /**
   * {@inheritDoc}
   */
  public function setFrom(string $email, string $name): void {
    $this->mailer->setFrom($email, $name);
  }

  /**
   * {@inheritDoc}
   */
  public function addAddress(string $email, string $name): void {
    $this->mailer->addAddress($email, $name);
  }

  /**
   * {@inheritDoc}
   */
  public function addReplyTo(string $email, string $name): void {
    $this->mailer->addReplyTo($email, $name);
  }

  /**
   * {@inheritDoc}
   */
  public function addCc(string $email, string $name): void {
    $this->mailer->addCC($email, $name);
  }

  /**
   * {@inheritDoc}
   */
  public function addBcc(string $email, string $name): void {
    $this->mailer->addBCC($email, $name);
  }

  /**
   * {@inheritDoc}
   */
  public function setSubject(string $subject): void {
    $this->mailer->Subject = $subject;
  }

  /**
   * {@inheritDoc}
   */
  public function setBody(string $baseViewPath, string $mail, string $plainTextMail, array $content = []): void {
    $this->mailer->Body = (string) new MailView($baseViewPath, $mail, $content);
    $this->setAltBody(
          (string) new MailView($baseViewPath, $plainTextMail, $content)
      );
  }

  /**
   * {@inheritDoc}
   */
  public function setAltBody(string $body): void {
    $this->mailer->AltBody = $this->mailer->html2text($body);
  }

  /**
   * {@inheritDoc}
   */
  public function setHtmlMessage(string $message, string $baseDir): void {
    $this->mailer->msgHTML($message, $baseDir);
  }

  /**
   * {@inheritDoc}
   */
  public function addAttachment(
    string $path,
    string $name = '',
    string $encoding = PHPMailer::ENCODING_BASE64,
    string $type = ''
  ): void {
    $this->mailer->addAttachment($path, $name, $encoding, $type);
  }

  /**
   * {@inheritDoc}
   */
  public function addEmbeddedImage(
    string $path,
    string $cid,
    string $name = '',
    string $encoding = PHPMailer::ENCODING_BASE64,
    string $type = ''
  ): void {
    $this->mailer->addEmbeddedImage($path, $cid, $name, $encoding, $type);
  }

  /**
   * {@inheritDoc}
   */
  public function send(): bool {
    return $this->mailer->send();
  }

}
