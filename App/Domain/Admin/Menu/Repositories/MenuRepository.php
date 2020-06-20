<?php

namespace App\Domain\Admin\Menu\Repositories;

/**
 *
 */
final class MenuRepository {
  private ?object $menu;

  private int $id;
  private string $title;
  private int $weight;
  private bool $isDeleted;

  private int $slugId;
  private string $slug;
  private bool $slugIsDeleted;

  /**
   *
   */
  public function __construct(?object $menu) {
    $this->menu = $menu;

    $this->id = (int) ($menu->menu_ID ?? '0');
    $this->title = $menu->menu_title ?? '';
    $this->weight = (int) ($menu->menu_weight ?? '0');
    $this->isDeleted = (bool) ($menu->menu_is_deleted ?? '0');

    $this->slugId = (int) ($menu->slug_ID ?? '0');
    $this->slug = $menu->slug_name ?? '';
    $this->slugIsDeleted = (bool) ($menu->slug_is_deleted ?? '0');
  }

  /**
   *
   */
  public function get(): ?object {
    return $this->menu;
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
  public function getTitle(): string {
    return $this->title;
  }

  /**
   *
   */
  public function getWeight(): int {
    return $this->weight;
  }

  /**
   *
   */
  public function isDeleted(): bool {
    return $this->isDeleted;
  }

  /**
   *
   */
  public function getSlugId(): int {
    return $this->slugId;
  }

  /**
   *
   */
  public function getSlug(): string {
    return $this->slug;
  }

  /**
   *
   */
  public function isSlugIsDeleted(): bool {
    return $this->slugIsDeleted;
  }

}
