<?php
declare(strict_types=1);


namespace App\Src\Mail;


use PHPMailer\PHPMailer\PHPMailer;

final class Mail
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        $this->mailer->isHTML(true);
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

    public function addCC(string $email, string $name): void
    {
        $this->mailer->addCC($email, $name);
    }

    public function addBCC(string $email, string $name): void
    {
        $this->mailer->addBCC($email, $name);
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    public function setBody(string $body): void
    {
        $this->mailer->Body = $body;
        $this->setAltBody($body);
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

    public function send(): void
    {
        $this->mailer->send();
    }
}
