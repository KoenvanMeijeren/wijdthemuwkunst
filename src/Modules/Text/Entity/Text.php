<?php
declare(strict_types=1);

namespace Modules\Text\Entity;

use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the text entity.
 *
 * @package Domain\Admin\Text\Entity
 */
#[ContentEntityType(
  table: 'translation',
  repository: TextRepository::class
)]
final class Text extends EntityStatusBase implements TextInterface {

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

}
