<?php
declare(strict_types=1);

namespace Modules\Menu\Actions;

use Components\Translation\TranslationOld;
use Modules\Menu\Entity\Menu;
use System\Entity\Actions\EntityFormActionBase;
use System\Entity\EntityInterface;
use System\State;

/**
 * Provides a base class for menu actions.
 *
 * @package Modules\Menu\Actions
 */
abstract class BaseMenuAction extends EntityFormActionBase {

  /**
   * The text entity.
   *
   * @var \Modules\Menu\Entity\MenuInterface|null
   */
  protected ?EntityInterface $entity;

  /**
   * {@inheritDoc}
   */
  final public function getEntityType(): string {
    return Menu::class;
  }

  /**
   * {@inheritDoc}
   */
  protected function saveEntity(): bool {
    $status = $this->entity->save();
    switch ($status) {
      case EntityInterface::SAVED_NEW:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('menu_item_successful_created'), $this->entity->getTitle())
        );

        return TRUE;

      case EntityInterface::SAVED_UPDATED:
        $this->session()->flash(State::SUCCESSFUL->value,
          sprintf(TranslationOld::get('menu_item_successful_updated'), $this->entity->getTitle())
        );

        return TRUE;

      default:
        $this->session()->flash(State::FAILED->value,
          sprintf(TranslationOld::get('menu_item_unsuccessful_update'), $this->entity->getTitle())
        );

        return FALSE;
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('url', TranslationOld::get('url'))->isRequired();
    $this->validator->input('title', TranslationOld::get('title'))->isRequired();
    $this->validator->input('weight', TranslationOld::get('weight'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
