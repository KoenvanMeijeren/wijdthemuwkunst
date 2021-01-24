<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\ViewModels;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Settings\Repositories\SettingRepository;
use Src\Resource\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
 */
final class SettingTable extends DataTableBuilder {

  /**
   * @inheritDoc
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRow(object $data): array {
    $setting = new SettingRepository($data);

    return [
      $setting->getReadableKey(),
      $setting->getValue(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $setting = new SettingRepository($data);
    $user = new User();

    return Resource::addTableEditColumn(
          '/admin/configuration/settings/setting/edit/' . $setting->getId(),
          '/admin/configuration/settings/setting/delete/' . $setting->getId(),
          sprintf(
              TranslationOld::get('delete_setting_confirmation_message'),
              $setting->getKey()
          ),
          $user->getRights() !== User::DEVELOPER
      );
  }

}
