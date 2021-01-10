<?php

declare(strict_types=1);


namespace Domain\Contact\Controllers;

use Components\Header\Redirect;
use Components\SuperGlobals\Url\Uri;
use Domain\Admin\ContactForm\Actions\SaveContactFormMessageAction;
use Domain\Contact\Actions\ContactAction;
use System\Controller\ControllerBase;

/**
 * The contact controller.
 *
 * @package Domain\Contact\Controllers
 */
final class ContactController extends ControllerBase {

  /**
   * Sends the contact request to the specified contact persons.
   *
   * @return \Components\Header\Redirect
   *   The page to redirect to.
   */
  public function send(): Redirect {
    $contact = new ContactAction();
    $saveContact = new SaveContactFormMessageAction();

    if ($contact->execute() && $saveContact->execute()) {
      return new Redirect('/contact-aanvraag-verzonden');
    }

    $this->session()->save('name', $this->request()->post('name'));
    $this->session()->save('email', $this->request()->post('email'));
    $this->session()->save('message', $this->request()->post('message'));

    $redirectUrl = Uri::getPreviousUrl();
    if ($redirectUrl === '') {
      return new Redirect('/#footer');
    }

    return new Redirect("$redirectUrl#footer");
  }

}
