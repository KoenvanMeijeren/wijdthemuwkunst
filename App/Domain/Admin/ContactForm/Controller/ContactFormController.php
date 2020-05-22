<?php


namespace App\Domain\Admin\ContactForm\Controller;


use App\Domain\Admin\ContactForm\Actions\DeleteContactFormMessageAction;
use App\Domain\Admin\ContactForm\Model\ContactForm;
use App\System\Controller\AdminControllerBase;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class ContactFormController extends AdminControllerBase
{
    private ContactForm $contactForm;
    protected string $baseViewPath = 'Admin/ContactForm/Views/';

    public function __construct()
    {
        parent::__construct();

        $this->contactForm = new ContactForm();
    }

    public function index(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_contact_form_title'),
            'messages' => $this->contactForm->getAll(),
        ]);
    }

    public function showByDate(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_contact_form_title'),
            'messages' => $this->contactForm->getByDate(
                $this->request->get('date')
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
