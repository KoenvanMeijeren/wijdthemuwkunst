<?php

namespace Modules\ContactForm\Entity;

use Components\Converter\Slug;
use System\Entity\EntityBase;

/**
 * Defines the ContactForm entity.
 *
 * @package Modules\ContactForm\Entity
 */
final class ContactForm extends EntityBase implements ContactFormInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'contact_form';

  /**
   * {@inheritdoc}
   */
  protected string $repository = ContactFormRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setKey(string $key): ContactFormInterface {
    $slug = new Slug($key);
    $this->set('key', str_replace('-', '_', $slug->parse()));
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getKey(): ?string {
    return $this->get('key');
  }

  /**
   * {@inheritDoc}
   */
  public function getReadableKey(): ?string {
    $key = ucfirst($this->getKey());

    return str_replace('_', ' ', $key);
  }

  /**
   * {@inheritDoc}
   */
  public function setValue(string $value): ContactFormInterface {
    $this->set('value', $value);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getValue(): ?string {
    return $this->get('value');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): ContactFormInterface {
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
