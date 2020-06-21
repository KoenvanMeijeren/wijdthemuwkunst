<?php

namespace Domain\Admin\Text\ViewModels;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\Repositories\TextRepository;
use Src\Translation\Translation;
use Support\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
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
  protected function buildRow(object $data): array {
    $text = new TextRepository($data);

    return [
      $text->getReadableKey(),
      $text->getValue(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $text = new TextRepository($data);
    $user = new User();

    return Resource::addTableEditColumn(
          '/admin/configuration/texts/text/edit/' . $text->getId(),
          '/admin/configuration/texts/text/delete/' . $text->getId(),
          sprintf(
              Translation::get('delete_text_confirmation_message'),
              $text->getKey()
          ),
          $user->getRights() !== User::DEVELOPER
      );
  }

}
