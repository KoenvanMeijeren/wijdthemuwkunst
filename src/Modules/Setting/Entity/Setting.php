<?php

namespace Modules\Setting\Entity;

use Components\Converter\Slug;
use System\Entity\EntityBase;

/**
 * Defines the setting entity.
 *
 * @package Modules\Setting\Entity
 */
final class Setting extends EntityBase implements SettingInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'setting';

  /**
   * {@inheritdoc}
   */
  protected string $repository = SettingRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setKey(string $key): SettingInterface {
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
  public function setValue(string $value): SettingInterface {
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
  public function setDeleted(bool $deleted = TRUE): SettingInterface {
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
