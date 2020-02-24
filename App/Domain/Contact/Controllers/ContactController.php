<?php
declare(strict_types=1);


namespace App\Domain\Contact\Controllers;

use App\Domain\Contact\Actions\ContactAction;
use Src\Core\Request;
use Src\Response\Redirect;
use Src\Session\Session;

final class ContactController
{
    public function send(): Redirect
    {
        $contact = new ContactAction();

        if ($contact->execute()) {
            return new Redirect('/contact-verzonden');
        }

        $request = new Request();
        $session = new Session();

        $session->save('name', $request->post('name'));
        $session->save('email', $request->post('email'));
        $session->save('message', $request->post('message'));

        return new Redirect('/#footer');
    }
}
