<?php
declare(strict_types=1);


namespace App\Domain\Contact\Controllers;


use App\Src\Mail\Mail;
use Src\Response\Redirect;

final class ContactController
{
    public function send()
    {
        $mail = new Mail();

        $mail->setFrom('koenvanmeijeren@gmail.com', 'Koen');
        $mail->addAddress('info@wijdthemuwkunst.nl', 'Wijdt Hem Uw Kunst');
        $mail->setBody('contact');

        $mail->send();

        return new Redirect('/contact-verzonden');
    }
}
