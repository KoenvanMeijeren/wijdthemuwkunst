<?php
declare(strict_types=1);

namespace Modules\Slug;

use Components\Converter\Slug as SlugConverter;
use Components\Database\QueryInterface;
use Modules\Slug\Entity\Slug;
use Modules\Slug\Entity\SlugInterface;
use System\Entity\EntityManager;

/**
 * Provides a trait for entities who uses the slug entity.
 *
 * @package Modules\Slug
 */
trait SlugTrait {

  /**
   * {@inheritDoc}
   */
  public function setSlug(string $url) {
    $slug = (new SlugConverter($url))->parse();
    $entity = $this->firstOrCreateSlug($slug);

    $this->set('slug_ID', $entity->id());
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getSlug(): ?string {
    return $this->get('slug_name');
  }

  /**
   * Gets the first or creates a slug entity.
   *
   * @param string $slug
   *   The slug.
   *
   * @return SlugInterface
   *   The first or created slug entity.
   */
  protected function firstOrCreateSlug(string $slug): SlugInterface {
    $entity_manager = new EntityManager();
    $storage = $entity_manager->getStorage(Slug::class);

    /** @var SlugInterface $entity */
    $entity = $storage->loadByAttributes(['slug_name' => $slug,]);
    if ($entity === null) {
      $entity = $storage->create();
      $entity->setName($slug);
      $entity->save();
      $entity = $storage->loadByAttributes(['slug_name' => $slug,]);
    }

    return $entity;
  }

  /**
   * Adds an inner join for the slug entity reference.
   *
   * @param QueryInterface $query
   *   The query definition.
   * @param string $tableTwo
   *   The second table to join on.
   */
  protected function addSlugJoin(QueryInterface $query, string $tableTwo): void {
    $query->innerJoin('slug', 'slug_ID', $tableTwo);
  }

  /**
   * Adds the slug filters.
   *
   * @param QueryInterface $query
   *   The query object.
   */
  protected function addSlugFilter(QueryInterface $query): void {
    $query->where('slug_is_deleted', '=', '0');
  }

  /**
   * Removes the attributes from the entity for saving.
   *
   * @param string[] $attributes
   *   The entity values indexed by column name.
   */
  protected function removeSlugAttributesForSaving(array &$attributes): void {
    unset($attributes['page_slug_name'], $attributes['page_slug_is_deleted']);
  }

}
