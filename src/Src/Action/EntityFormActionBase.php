<?php

namespace Src\Action;

use System\Entity\EntityInterface;
use System\Entity\EntityManager;
use System\Entity\EntityManagerInterface;

/**
 * Provides a base for entity form actions.
 *
 * @package src\Action
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
  }

  /**
   * Saves the entity and flashes a message into the session.
   *
   * @return bool
   *   Whether the entity was saved successfully or not.
   */
  abstract protected function saveEntity(): bool;

}
