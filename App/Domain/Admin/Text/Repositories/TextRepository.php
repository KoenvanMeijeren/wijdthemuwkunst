<?php

namespace Domain\Admin\Text\Repositories;

/**
 *
 */
final class TextRepository {
  private ?object $text;

  private int $id;
  private string $key;
  private string $value;
  private string $language;
  private bool $isDeleted;

  /**
   *
   */
  public function __construct(?object $text) {
    $this->text = $text;

    $this->id = (int) ($text->translation_ID ?? '0');
    $this->key = $text->translation_key ?? '';
    $this->value = $text->translation_value ?? '';
    $this->language = $text->translation_languge ?? '';
    $this->isDeleted = (bool) ($text->translation_is_deleted ?? '0');
  }

  /**
   *
   */
  public function get(): ?object {
    return $this->text;
  }

  /**
   *
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   *
   */
  public function getKey(): string {
    return $this->key;
  }

  /**
   *
   */
  public function getReadableKey(): string {
    $key = ucfirst($this->getKey());

    return str_replace('_', ' ', $key);
  }

  /**
   *
   */
  public function getValue(): string {
    return $this->value;
  }

  /**
   *
   */
  public function getLanguage(): string {
    return $this->language;
  }

  /**
   *
   */
  public function isDeleted(): bool {
    return $this->isDeleted;
  }

}
