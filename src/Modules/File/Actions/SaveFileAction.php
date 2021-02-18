<?php
declare(strict_types=1);

namespace Modules\File\Actions;

use System\Entity\Actions\EntityActionBase;
use Modules\File\Entity\File;
use System\Entity\EntityInterface;

/**
 * Provides a save file action.
 *
 * @package Modules\File\Actions
 */
final class SaveFileAction extends EntityActionBase {

  /**
   * The file entity.
   *
   * @var \Modules\File\Entity\FileInterface
   */
  protected EntityInterface $entity;

  /**
   * SaveFileAction constructor.
   *
   * @param string $path
   *   The path of the file.
   */
  public function __construct(
    protected string $path
  ) {
    parent::__construct();

    $entity = $this->storage->loadByAttributes([
      $this->entity->getTable() . '_path' => $this->path,
    ]);
    if ($entity !== null) {
      $this->entity = $entity;
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function getEntityType(): string {
    return File::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    new self($this->entity->getPath());

    return match ($status) {
      EntityInterface::SAVED_NEW, EntityInterface::SAVED_UPDATED => TRUE,
      default => FALSE,
    };
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPath($this->path);

    return $this->saveEntity();
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
