<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\Entity\Text;
use Src\Action\EntityFormActionBase;
use Src\Core\StateInterface;
use Src\Translation\Translation;
use System\Entity\EntityInterface;

/**
 * Provides a base class for text actions.
 *
 * @package Domain\Admin\Text\Actions
 */
abstract class BaseTextAction extends EntityFormActionBase {

  /**
   * The current user definition.
   *
   * @var \Domain\Admin\Accounts\User\Models\User
   */
  protected User $user;

  /**
   * BaseTextAction constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->user = new User();

    $storage = $this->entityManager->getStorage(Text::class);
    $this->entity = $storage->create();
    if ($id = $this->request->getRouteParameter()) {
      $this->entity = $storage->load((int) $id);
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    /** @var \Domain\Admin\Text\Entity\TextInterface $entity */
    $entity = $this->entity;

    $status = $entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session->flash(StateInterface::SUCCESSFUL,
          sprintf(Translation::get('text_successful_created'), $entity->getKey())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session->flash(StateInterface::SUCCESSFUL,
          sprintf(Translation::get('text_successful_updated'), $entity->getKey())
        );

        return TRUE;

      default:
        $this->session->flash(StateInterface::FAILED,
          sprintf(Translation::get('text_unsuccessful_updated'), $entity->getKey())
        );

        return FALSE;
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('key', Translation::get('key'))->isRequired();
    $this->validator->input('value', Translation::get('value'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
