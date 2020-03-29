<?php


namespace App\Domain\Admin\ContactForm\Repository;


use Cake\Chronos\Chronos;
use Support\DateTime;

final class ContactFormRepository
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $message;
    protected string $createdAt;
    protected bool $softDeleted;

    public function __construct(?object $contactForm)
    {
        $this->id = (int) ($contactForm->contact_form_id ?? 0);
        $this->name = $contactForm->contact_form_name ?? '';
        $this->email = $contactForm->contact_form_email ?? '';
        $this->message = $contactForm->contact_form_message ?? '';
        $this->createdAt = $contactForm->contact_form_created_at ?? '';
        $this->softDeleted = (bool) ($contactForm->contact_form_soft_deleted ?? 0);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function convertDateTime(): DateTime
    {
        return new DateTime(new Chronos($this->getCreatedAt()));
    }

    public function isSoftDeleted(): bool
    {
        return $this->softDeleted;
    }
}
