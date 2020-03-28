<?php


namespace App\Domain\Admin\ContactForm\Actions;


use App\Domain\Admin\ContactForm\Model\ContactForm;
use App\Domain\Admin\ContactForm\Repository\ContactFormRepository;
use Cake\Chronos\Chronos;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\Validate\form\FormValidator;

abstract class BaseContactFormAction extends FormAction
{
    protected ContactForm $contactForm;
    protected ContactFormRepository $repository;
    protected FormValidator $validator;
    protected Session $session;

    protected int $id;
    protected string $name;
    protected string $email;
    protected string $message;

    protected array $attributes = [];

    public function __construct()
    {
        $request = new Request();
        $this->contactForm = new ContactForm();
        $this->repository = new ContactFormRepository(
            $this->contactForm->find($this->contactForm->getId())
        );
        $this->validator = new FormValidator();
        $this->session = new Session();

        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->message = $request->post('message');

        $this->attributes = [
          'contact_form_name' => $this->name,
          'contact_form_email' => $this->email,
          'contact_form_message' => $this->message,
          'contact_form_created_at' => (new Chronos())->toDateTimeString()
        ];
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $this->validator->input($this->name, 'Naam')->isRequired();
        $this->validator->input($this->email, 'Email')->isRequired()->isEmail();
        $this->validator->input($this->message, 'Bericht')->isRequired();

        return $this->validator->handleFormValidation();
    }
}
