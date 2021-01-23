<?php
declare(strict_types=1);

namespace Domain\Admin\Text\Actions;

use Components\Actions\EntityFormActionBase;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\Entity\Text;
use Components\Translation\TranslationOld;
use System\Entity\EntityInterface;
use System\StateInterface;

/**
 * Provides a base class for text actions.
 *
 * @package Domain\Admin\Text\Actions
 */
abstract class BaseTextAction extends EntityFormActionBase {

  /**
   * The text entity.
   *
   * @var \Domain\Admin\Text\Entity\TextInterface
   */
  protected EntityInterface $entity;

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
  }

  /**
   * {@inheritDoc}
   */
  protected function getEntityType(): string {
    return Text::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('text_successful_created'), $this->entity->getKey())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session()->flash(StateInterface::SUCCESSFUL,
          sprintf(TranslationOld::get('text_successful_updated'), $this->entity->getKey())
        );

        return TRUE;

      default:
        $this->session()->flash(StateInterface::FAILED,
          sprintf(TranslationOld::get('text_unsuccessful_updated'), $this->entity->getKey())
        );

        return FALSE;
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('key', TranslationOld::get('key'))->isRequired();
    $this->validator->input('value', TranslationOld::get('value'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
