<?php

namespace Domain\Admin\Text\Entity;

use DI\Annotation\Inject;
use System\Entity\EntityBase;

/**
 * Defines the text entity.
 *
 * @package Domain\Admin\Text\Entity
 */
final class Text extends EntityBase implements TextInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'translation';

  /**
   * {@inheritdoc}
   */
  protected string $repository = TextRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setKey(string $key) {
    $this->set('key', $key);
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
  public function setValue(string $value) {
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
  public function setLanguage(string $language) {
    $this->set('language', $language);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getLanguage(): ?string {
    return $this->get('language');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE) {
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
