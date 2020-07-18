<?php

namespace Domain\Admin\Text\Entity;

use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use Support\Resource;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for text entities.
 *
 * @package Domain\Admin\Text\Entity
 */
final class TextTable extends DataTableBuilder {

  /**
   * @inheritDoc
   */
  protected function buildHead(): array {
    return [
      Translation::get('table_row_key'),
      Translation::get('table_row_value'),
      Translation::get('table_row_edit'),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRow(EntityInterface $entity): array {
    return [
      $entity->getKey(),
      $entity->getValue(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(EntityInterface $entity): string {
    $user = new User();

    return Resource::addTableEditColumn(
      '/admin/configuration/texts/text/edit/' . $entity->id(),
      '/admin/configuration/texts/text/delete/' . $entity->id(),
      sprintf(
        Translation::get('delete_text_confirmation_message'),
        $entity->getKey()
      ),
      $user->getRights() !== User::DEVELOPER
    );
  }

}
