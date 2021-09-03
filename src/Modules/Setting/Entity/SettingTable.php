<?php

namespace Modules\Setting\Entity;

use Components\ComponentsTrait;
use Components\Resource\Resource;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for text entities.
 *
 * @package Modules\Setting\Entit
 */
final class SettingTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function buildRow(EntityInterface $entity): array {
    return [
      $entity->getKey(),
      $entity->getValue(),
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function buildRowActions(EntityInterface $entity): string {
    return Resource::addTableEditColumn(
      '/admin/configuration/settings/setting/edit/' . $entity->id(),
      '/admin/configuration/settings/setting/delete/' . $entity->id(),
      sprintf(
        TranslationOld::get('delete_setting_confirmation_message'),
        $entity->getKey()
      ),
      $this->currentUser()->getRights() !== User::DEVELOPER
    );
  }

}
