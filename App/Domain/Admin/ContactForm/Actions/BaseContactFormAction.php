<?php

declare(strict_types=1);

namespace Domain\Admin\ContactForm\Actions;

use Cake\Chronos\Chronos;
use Domain\Admin\ContactForm\Model\ContactForm;
use Domain\Admin\ContactForm\Repository\ContactFormRepository;
use Src\Action\FormAction;
use Src\Translation\Translation;

/**
 * Provides a base class for contact form actions.
 *
 * @package Domain\Admin\ContactForm\Actions
 */
abstract class BaseContactFormAction extends FormAction {

  /**
   * The contact form definition.
   *
   * @var \Domain\Admin\ContactForm\Model\ContactForm
   */
  protected ContactForm $contactForm;

  /**
   * The contact form repository.
   *
   * @var \Domain\Admin\ContactForm\Repository\ContactFormRepository
   */
  protected ContactFormRepository $repository;

  /**
   * The id of the contact form message.
   *
   * @var int
   */
  protected int $id;

  /**
   * The name of the contact person.
   *
   * @var string
   */
  protected string $name;

  /**
   * The email of the contact person.
   *
   * @var string
   */
  protected string $email;

  /**
   * The message of the contact request.
   *
   * @var string
   */
  protected string $message;

  /**
   * The attributes to be updated in the database.
   *
   * @var array
   */
  protected array $attributes = [];

  /**
   * BaseContactFormAction constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->contactForm = new ContactForm();
    $this->repository = new ContactFormRepository(
          $this->contactForm->find($this->contactForm->getId())
      );

    $this->name = $this->request->post('name');
    $this->email = $this->request->post('email');
    $this->message = $this->request->post('message');

    $this->attributes = [
      'contact_form_name' => $this->name,
      'contact_form_email' => $this->email,
      'contact_form_message' => $this->message,
      'contact_form_created_at' => (new Chronos())->toDateTimeString(),
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input($this->name, Translation::get('name'))->isRequired();
    $this->validator->input($this->email, Translation::get('email'))->isRequired()->isEmail();
    $this->validator->input($this->message, Translation::get('message'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
