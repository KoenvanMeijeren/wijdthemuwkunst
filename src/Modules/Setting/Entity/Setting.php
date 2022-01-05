<?php
declare(strict_types=1);

namespace Modules\Setting\Entity;

use Components\Converter\Slug;
use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the setting entity.
 *
 * @package Modules\Setting\Entity
 */
#[ContentEntityType(
  table: 'setting',
  repository: SettingRepository::class
)]
final class Setting extends EntityStatusBase implements SettingInterface {

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

}
