<?php
declare(strict_types=1);


namespace App\Domain\Contact\Controllers;

use App\Domain\Contact\Actions\ContactAction;
use Src\Response\Redirect;

final class ContactController
{
    public function send(): Redirect
    {
        $contact = new ContactAction();

        if ($contact->execute()) {
            return new Redirect('/contact-verzonden');
        }

        return new Redirect('/#footer');
    }
}
