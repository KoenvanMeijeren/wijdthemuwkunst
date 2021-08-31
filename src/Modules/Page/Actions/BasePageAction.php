<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Modules\File\Actions\SaveFileAction;
use Modules\Page\Entity\Page;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\StateInterface;

/**
 * Provides a base class for page actions.
 *
 * @package Domain\Admin\Text\Actions
 */
abstract class BasePageAction extends EntityFormActionBase {

  /**
   * The page entity.
   *
   * @var \Modules\Page\Entity\PageInterface
   */
  protected EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Page::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('page_successfully_created'), $this->entity->getTitle())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('page_successfully_updated'), $this->entity->getTitle())
        );

        return TRUE;

      default:
        $this->session()->flash(StateInterface::FAILED,
          sprintf(TranslationOld::get('page_unsuccessfully_updated'), $this->entity->getTitle())
        );

        return FALSE;
    }
  }

  /**
   * Get the location of the file, save it and return the id.
   */
  protected function getFileId(string $fileLocation): int {
    if ($fileLocation === '') {
      return 0;
    }

    $fileLocation = json_decode(html_entities_decode($fileLocation), TRUE, 512, JSON_THROW_ON_ERROR);

    if (isset($fileLocation['location'])) {
      return 0;
    }

    $saveFile = new SaveFileAction($fileLocation['location']);
    $saveFile->execute();

    return $saveFile->getEntityId();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('title', TranslationOld::get('title'))->isRequired();

    if ($this->request()->post('slug') !== $this->entity->getSlug()) {
      $this->validator->input('slug', TranslationOld::get('slug'))
        ->isRequired()
        ->isUnique(
          $this->entityManager->loadByAttributes([
            'slug_name' => (string) $this->entity->getSlug()
          ]),
          sprintf(TranslationOld::get('page_already_exists'), $this->entity->getSlug())
        );
    }

    $this->validator->input('menu', TranslationOld::get('page_visibility'))
      ->isRequired()
      ->isInArray([Page::PAGE_NORMAL, Page::PAGE_STATIC,]);

    $this->validator->input('content', TranslationOld::get('page_content'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
