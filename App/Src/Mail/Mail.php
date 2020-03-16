<?php
declare(strict_types=1);


namespace App\Src\Mail;

use Domain\Admin\Settings\Models\Setting;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Src\Core\Env;
use Src\Core\Request;
use Src\View\MailView;

final class Mail
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $env = new Env();
        $request = new Request();

        // set mail credentials
        if ($env->get() === Env::PRODUCTION) {
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mailer->Host = $request->env('mail_host');
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $request->env('mail_username');
            $this->mailer->Password = $request->env('mail_password');
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $request->env('mail_port');
        }

        $this->mailer->isHTML(true);

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

    public function setFrom(string $email, string $name): void
    {
        $this->mailer->setFrom($email, $name);
    }

    public function addAddress(string $email, string $name): void
    {
        $this->mailer->addAddress($email, $name);
    }

    public function addReplyTo(string $email, string $name): void
    {
        $this->mailer->addReplyTo($email, $name);
    }

    public function addCc(string $email, string $name): void
    {
        $this->mailer->addCC($email, $name);
    }

    public function addBcc(string $email, string $name): void
    {
        $this->mailer->addBCC($email, $name);
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    public function setBody(string $baseViewPath, string $mail, string $plainTextMail, array $content = []): void
    {
        $this->mailer->Body = new MailView($baseViewPath, $mail, $content);
        $this->setAltBody(
            (string) new MailView($baseViewPath, $plainTextMail, $content)
        );
    }

    public function setAltBody(string $body): void
    {
        $this->mailer->AltBody = $this->mailer->html2text($body);
    }

    public function setHtmlMessage(string $message, string $baseDir): void
    {
        $this->mailer->msgHTML($message, $baseDir);
    }

    public function addAttachment(
        string $path,
        string $name = '',
        string $encoding = PHPMailer::ENCODING_BASE64,
        string $type = ''
    ): void {
        $this->mailer->addAttachment($path, $name, $encoding, $type);
    }

    public function addEmbeddedImage(
        string $path,
        string $name = '',
        string $encoding = PHPMailer::ENCODING_BASE64,
        string $type = ''
    ): void {
        $this->mailer->addEmbeddedImage($path, $name, $encoding, $type);
    }

    public function send(): bool
    {
        return $this->mailer->send();
    }
}
