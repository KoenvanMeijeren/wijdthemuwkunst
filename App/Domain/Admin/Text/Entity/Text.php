<?php

namespace Domain\Admin\Text\Entity;

use Domain\Admin\Pages\Models\Slug;
use System\Entity\EntityBase;

/**
 * Defines the text entity.
 *
 * @package Domain\Admin\Text\Entity
 */
final class Text extends EntityBase implements TextInterface {

  /**
   * The name of the table of the text entity.
   *
   * @var string
   */
  protected string $table = 'translation';

  /**
   * The name of the repository of the text entity.
   *
   * @var string
   */
  protected string $repository = TextRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setKey(string $key) {
    $slug = new Slug();
    $this->set('key', str_replace('-', '_', $slug->parse($key)));
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
