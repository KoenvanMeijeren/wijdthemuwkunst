<?php

namespace Components\Actions;

use System\Entity\EntityInterface;
use System\Entity\EntityManager;
use System\Entity\EntityManagerInterface;

/**
 * Provides a base for entity form actions.
 *
 * @package Components\Actions
 */
abstract class EntityFormActionBase extends FormAction {

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
   * EntityFormActionBase constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->entityManager = new EntityManager();
    $storage = $this->entityManager->getStorage($this->getEntityType());
    $this->entity = $storage->create();
    if ($id = $this->request()->getRouteParameter()) {
      $this->entity = $storage->load((int) $id);
    }
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
