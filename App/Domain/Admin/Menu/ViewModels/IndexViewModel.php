<?php


namespace App\Domain\Admin\Menu\ViewModels;


use App\Domain\Admin\Menu\Repositories\MenuRepository;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $menu;

    private DataTable $dataTable;

    /**
     * @param object[] $menu
     */
    public function __construct(array $menu)
    {
        $this->menu = $menu;
        $this->dataTable = new DataTable();
    }

    public function getTable(): string
    {
        $this->dataTable->addHead(
            Translation::get('table_row_slug'),
            Translation::get('table_row_title'),
            Translation::get('table_row_menu_item_weight'),
            Translation::get('table_row_edit'),
        );

        foreach ($this->menu as $item) {
            $menuItem = new MenuRepository($item);

            $slug = "<a href='/{$menuItem->getSlug()}' target='_blank'>{$menuItem->getTitle()}</a>";

            $this->dataTable->addRow(
                $slug,
                $menuItem->getTitle(),
                $menuItem->getWeight(),
                Resource::addTableEditColumn(
                    '/admin/menu/item/edit/' . $menuItem->getId(),
                    '/admin/menu/item/delete/' . $menuItem->getId(),
                    sprintf(
                        Translation::get('delete_menu_item_confirmation_message'),
                        $menuItem->getTitle()
                    )
                )
            );
        }

        return $this->dataTable->get();
    }
}
