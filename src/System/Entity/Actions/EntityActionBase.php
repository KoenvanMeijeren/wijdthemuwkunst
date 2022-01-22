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
abstract class EntityActionBase extends Action implements EntityActionInterface {

  /**
   * The entity manager definition.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  protected readonly EntityManagerInterface $entityManager;

  /**
   * The entity definition.
   *
   * @var \System\Entity\EntityInterface|null
   */
  protected readonly ?EntityInterface $entity;

  /**
   * The storage.
   *
   * @var EntityManagerInterface
   */
  protected readonly EntityManagerInterface $storage;

  /**
   * EntityActionBase constructor.
   */
  public function __construct() {
    $this->entityManager = new EntityManager();
    $this->storage = $this->entityManager->getStorage($this->getEntityType());
    $this->entity = $this->getEntity();
  }

  /**
   * Gets the entity.
   *
   * @return \System\Entity\EntityInterface|null
   *   The entity.
   */
  protected function getEntity(): ?EntityInterface {
    $entity = $this->storage->create();
    if ($id = $this->request()->getRouteParameter()) {
      $entity = $this->storage->getRepository()->loadById((int) $id);
    }

    return $entity;
  }

  /**
   * {@inheritDoc}
   */
  public function getEntityId(): ?int {
    return $this->entity?->id();
  }

  /**
   * Saves the entity and flashes a message into the session.
   *
   * @return bool
   *   Whether the entity was saved successfully or not.
   */
  abstract protected function saveEntity(): bool;

}
