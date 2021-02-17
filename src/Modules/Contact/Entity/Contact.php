<?php

namespace Modules\Contact\Entity;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;
use Components\Datetime\DateTimeInterface;
use System\Entity\EntityBase;

/**
 * Defines the Contact entity.
 *
 * @package Modules\Contact\Entity
 */
final class Contact extends EntityBase implements ContactInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'contact_form';

  /**
   * {@inheritdoc}
   */
  protected string $repository = ContactRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setName(string $name): ContactInterface {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getName(): ?string {
    return $this->get('name');
  }

  /**
   * {@inheritDoc}
   */
  public function setEmail(string $email): ContactInterface {
    $this->set('email', $email);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getEmail(): ?string {
    return $this->get('email');
  }

  /**
   * {@inheritDoc}
   */
  public function setMessage(string $message): ContactInterface {
    $this->set('message', $message);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getMessage(): ?string {
    return $this->get('message');
  }

  /**
   * {@inheritDoc}
   */
  public function setCreatedAt(DateTimeInterface $dateTime): ContactInterface {
    $this->set('created_at', $dateTime->format('Y-m-d H:i:s'));
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getCreatedAt(): ?string {
    return $this->get('created_at');
  }

  /**
   * {@inheritDoc}
   */
  public function getDateTime(): DateTimeInterface {
    return new DateTime(new Chronos($this->getCreatedAt()));
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): ContactInterface {
    $this->set('is_deleted', $deleted);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return (bool) $this->get('is_deleted');
  }

}
