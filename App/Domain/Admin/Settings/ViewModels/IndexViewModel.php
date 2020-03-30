<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\ViewModels;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Settings\Repositories\SettingRepository;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $settings;

    private DataTable $dataTable;

    /**
     * @param object[] $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
        $this->dataTable = new DataTable();
    }

    public function getTable(): string
    {
        $this->dataTable->addHead(
            Translation::get('table_row_key'),
            Translation::get('table_row_value'),
            Translation::get('table_row_edit')
        );

        $user = new User();
        foreach ($this->settings as $item) {
            $setting = new SettingRepository($item);

            $this->dataTable->addRow(
                $setting->getReadableKey(),
                $setting->getValue(),
                Resource::addTableEditColumn(
                    '/admin/setting/edit/' . $setting->getId(),
                    '/admin/setting/delete/' . $setting->getId(),
                    sprintf(
                        Translation::get('delete_setting_confirmation_message'),
                        $setting->getKey()
                    ),
                    $user->getRights() !== User::DEVELOPER
                )
            );
        }

        return $this->dataTable->get();
    }
}
