<?php
declare(strict_types=1);

namespace Modules\Contact\Controller;

use Components\Header\Redirect;
use Components\SuperGlobals\Url\Uri;
use Modules\Contact\Actions\ContactAction;
use Modules\Contact\Actions\SaveContactMessageAction;
use System\Controller\ControllerBase;

/**
 * The contact controller.
 *
 * @package Domain\Contact\Controllers
 */
final class ContactController extends ControllerBase {

  /**
   * ContactController constructor.
   *
   * {@inheritDoc}
   */
  public function __construct(){
    parent::__construct('Contact/Views/');
  }

  /**
   * Sends the contact request to the specified contact persons.
   *
   * @return \Components\Header\Redirect
   *   The page to redirect to.
   */
  public function send(): Redirect {
    $contact = new ContactAction();
    $saveContact = new SaveContactMessageAction();

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

    return new Redirect("{$redirectUrl}#footer");
  }

}
