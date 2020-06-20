<?php

declare(strict_types=1);


namespace App\Domain\Contact\Controllers;

use App\Domain\Admin\ContactForm\Actions\SaveContactFormMessageAction;
use App\Domain\Contact\Actions\ContactAction;
use App\System\Controller\ControllerBase;
use Src\Core\URI;
use Src\Response\Redirect;

/**
 * The contact controller.
 *
 * @package App\Domain\Contact\Controllers
 */
final class ContactController extends ControllerBase {

  /**
   * Sends the contact request to the specified contact persons.
   *
   * @return \Src\Response\Redirect
   *   The page to redirect to.
   */
  public function send(): Redirect {
    $contact = new ContactAction();
    $saveContact = new SaveContactFormMessageAction();

    if ($contact->execute() && $saveContact->execute()) {
      return new Redirect('/contact-aanvraag-verzonden');
    }

    $this->session->save('name', $this->request->post('name'));
    $this->session->save('email', $this->request->post('email'));
    $this->session->save('message', $this->request->post('message'));

    $redirectUrl = URI::getPreviousUrl();
    if ($redirectUrl === '') {
      return new Redirect('/#footer');
    }

    return new Redirect("$redirectUrl#footer");
  }

}
