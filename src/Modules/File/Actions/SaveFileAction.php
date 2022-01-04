<?php
declare(strict_types=1);

namespace Modules\File\Actions;

use Modules\File\Entity\File;
use System\Entity\Actions\EntityActionBase;
use System\Entity\EntityInterface;
use System\Entity\Status\EntitySaveStatus;

/**
 * Provides a save file action.
 *
 * @package Modules\File\Actions
 */
final class SaveFileAction extends EntityActionBase {

  /**
   * The file entity.
   *
   * @var \Modules\File\Entity\FileInterface|null
   */
  protected ?EntityInterface $entity;

  /**
   * SaveFileAction constructor.
   *
   * @param string $path
   *   The path of the file.
   */
  public function __construct(protected string $path) {
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
  public function getEntityType(): string {
    return File::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    new self($this->entity->getPath());

    return match ($status) {
      EntitySaveStatus::SAVED_NEW, EntitySaveStatus::SAVED_UPDATED => TRUE,
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
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
