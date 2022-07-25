<?php
declare(strict_types=1);

namespace System\Entity;

use System\Controller\ControllerBase;

/**
 * Provides a controller base for entities.
 *
 * @package System\Entity
 */
abstract class EntityControllerBase extends ControllerBase {

  /**
   * The entity manager definition.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  protected readonly EntityManagerInterface $entityManager;

  /**
   * The entity repository definition.
   *
   * @var \System\Entity\EntityRepositoryInterface
   */
  protected readonly EntityRepositoryInterface $repository;

  /**
   * {@inheritDoc}
   */
  public function __construct(string $entityClass, string $baseViewPath = '') {
    parent::__construct($baseViewPath);

    $this->entityManager = new EntityManager();
    $storage = $this->entityManager->getStorage($entityClass);
    $this->repository = $storage->getRepository();
  }

}
