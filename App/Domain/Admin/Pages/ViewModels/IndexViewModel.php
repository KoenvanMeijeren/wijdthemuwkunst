<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\ViewModels;

use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\Support\PageInMenuStateConverter;
use Domain\Admin\Pages\Support\PageIsPublishedStateConverter;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $pages;

    private DataTable $dataTable;

    /**
     * @param object[] $pages
     */
    public function __construct(array $pages)
    {
        $this->pages = $pages;
        $this->dataTable = new DataTable();
    }

    public function table(): string
    {
        $this->dataTable->addHead(
            Translation::get('table_row_slug'),
            Translation::get('table_row_title'),
            Translation::get('table_row_page_in_menu'),
            Translation::get('table_row_publish_state'),
            Translation::get('table_row_edit'),
        );

        foreach ($this->pages as $singlePage) {
            $page = new PageRepository($singlePage);
            $inMenuState = new PageInMenuStateConverter($page->getInMenu());
            $isPublishedState = new PageIsPublishedStateConverter(
                $page->isPublished()
            );

            if (!$page->isPublished()) {
                $this->dataTable->addClasses('row-warning');
            }

            $slug = "<a href='/{$page->getSlug()}' target='_blank'>{$page->getSlug()}</a>";

            $this->dataTable->addRow(
                $slug,
                $page->getTitle(),
                $inMenuState->toReadable(),
                $isPublishedState->toReadable(),
                Resource::addTableEditColumn(
                    '/admin/page/edit/' . $page->getId(),
                    '/admin/page/delete/' . $page->getId(),
                    Translation::get('delete_page_confirmation_message')
                )
            );
        }

        return $this->dataTable->get();
    }
}
