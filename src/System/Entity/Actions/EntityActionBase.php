<?php
declare(strict_types=1);

namespace System\Entity\Actions;

use Components\Actions\Action;
use System\Entity\EntityInterface;
use System\Entity\EntityManager;
use System\Entity\EntityManagerInterface;

/**
 * Provides a base for entity actions.
 *
 * @package Components\Actions
 */
abstract class EntityActionBase extends Action {

  /**
   * The entity manager definition.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  protected EntityManagerInterface $entityManager;

  /**
   * The entity definition.
   *
   * @var \System\Entity\EntityInterface
   */
  protected EntityInterface $entity;

  /**
   * The storage.
   *
   * @var EntityManagerInterface
   */
  protected EntityManagerInterface $storage;

  /**
   * EntityActionBase constructor.
   */
  public function __construct() {
    $this->entityManager = new EntityManager();
    $this->storage = $this->entityManager->getStorage($this->getEntityType());
    $this->entity = $this->storage->create();
    if ($id = $this->request()->getRouteParameter()) {
      $this->entity = $this->storage->load((int) $id);
    }
  }

  /**
   * Gets the entity id.
   *
   * @return int
   *   The entity id.
   */
  public function getEntityId(): int {
    return (int) $this->entity->id();
  }

  /**
   * Gets the entity type.
   *
   * @return string
   *   The entity type.
   */
  abstract protected function getEntityType(): string;

  /**
   * Saves the entity and flashes a message into the session.
   *
   * @return bool
   *   Whether the entity was saved successfully or not.
   */
  abstract protected function saveEntity(): bool;

}
