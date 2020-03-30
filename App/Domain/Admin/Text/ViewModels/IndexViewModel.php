<?php


namespace App\Domain\Admin\Text\ViewModels;


use App\Domain\Admin\Text\Repositories\TextRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $texts;

    private DataTable $dataTable;

    /**
     * @param object[] $settings
     */
    public function __construct(array $texts)
    {
        $this->texts = $texts;
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
        foreach ($this->texts as $item) {
            $text = new TextRepository($item);

            $this->dataTable->addRow(
                $text->getReadableKey(),
                $text->getValue(),
                Resource::addTableEditColumn(
                    '/admin/text/edit/' . $text->getId(),
                    '/admin/text/delete/' . $text->getId(),
                    sprintf(
                        Translation::get('delete_text_confirmation_message'),
                        $text->getKey()
                    ),
                    $user->getRights() !== User::DEVELOPER
                )
            );
        }

        return $this->dataTable->get();
    }
}
