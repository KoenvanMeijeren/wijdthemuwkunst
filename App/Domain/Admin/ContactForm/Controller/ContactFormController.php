<?php


namespace App\Domain\Admin\ContactForm\Controller;


use App\Domain\Admin\ContactForm\Actions\DeleteContactFormMessageAction;
use App\Domain\Admin\ContactForm\Model\ContactForm;
use Src\Core\Request;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class ContactFormController
{
    private ContactForm $contactForm;

    private string $baseViewPath = 'Admin/ContactForm/Views/';

    public function __construct()
    {
        $this->contactForm = new ContactForm();
    }

    public function index(): DomainView
    {
        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('admin_contact_form_title'),
            'messages' => $this->contactForm->getAll(),
        ]);
    }

    public function showByDate(): DomainView
    {
        $request = new Request();

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('admin_contact_form_title'),
            'messages' => $this->contactForm->getByDate(
                $request->get('date')
            ),
        ]);
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteContactFormMessageAction();
        $delete->execute();

        return new Redirect('/admin/content/contact-form');
    }
}
