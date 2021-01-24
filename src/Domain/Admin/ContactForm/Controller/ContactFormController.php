<?php

namespace Domain\Admin\ContactForm\Controller;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Domain\Admin\ContactForm\Actions\DeleteContactFormMessageAction;
use Domain\Admin\ContactForm\Model\ContactForm;
use Components\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 * The contact form controller.
 *
 * @package Domain\Admin\ContactForm\Controller
 */
final class ContactFormController extends AdminControllerBase {
  private ContactForm $contactForm;
  protected string $baseViewPath = 'Admin/ContactForm/Views/';

  /**
   * ContactFormController constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->contactForm = new ContactForm();
  }

  /**
   * Displays all contact requests.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_contact_form_title'),
      'messages' => $this->contactForm->getAll(),
    ]);
  }

  /**
   * Displays all contact request for a given date.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function showByDate(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_contact_form_title'),
      'messages' => $this->contactForm->getByDate(
              $this->request()->get('date')
      ),
    ]);
  }

  /**
   * Destroys one contact request.
   *
   * @return \Src\Core
   *   The redirect response.
   */
  public function destroy(): Redirect {
    $delete = new DeleteContactFormMessageAction();
    $delete->execute();

    return new Redirect('/admin/content/contact-form');
  }

}
