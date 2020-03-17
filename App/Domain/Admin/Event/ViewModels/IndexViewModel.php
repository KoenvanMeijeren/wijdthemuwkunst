<?php


namespace App\Domain\Admin\Event\ViewModels;

use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Event\Support\EventDatetimeConverter;
use App\Domain\Admin\Event\Support\EventIsPublishedStateConverter;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $events;

    private DataTable $dataTable;

    /**
     * @param object[] $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
        $this->dataTable = new DataTable();
    }

    public function table(): string
    {
        $this->dataTable->addHead(
            Translation::get('table_row_slug'),
            Translation::get('table_row_location'),
            Translation::get('table_row_datetime'),
            Translation::get('table_row_publish_state'),
            Translation::get('table_row_edit'),
        );

        foreach ($this->events as $singleEvent) {
            $event = new EventRepository($singleEvent);
            $isPublishedState = new EventIsPublishedStateConverter(
                $event->isPublished()
            );
            $dateTime = new EventDatetimeConverter(
                $event->getDatetime()
            );

            if (!$event->isPublished()) {
                $this->dataTable->addClasses('row-warning');
            }

            $slug = "<a href='/concert/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

            $actions = '<div class="table-edit-row flex">';
            $actions .= Resource::addTableLinkActionColumn(
                '/admin/concert/edit/' . $event->getId(),
                Translation::get('table_row_edit'),
                'fas fa-edit'
            );
            $actions .= Resource::addTableButtonActionColumn(
                '/admin/concert/archive/' . $event->getId(),
                'Archiveren',
                'fas fa-archive',
                'btn-warning',
                'Weet je zeker dat je dit concert wilt archiveren?'
            );
            $actions .= Resource::addTableButtonActionColumn(
                '/admin/concert/delete/' . $event->getId(),
                Translation::get('table_row_delete'),
                'fas fa-trash-alt',
                'btn-danger',
                Translation::get('delete_event_confirmation_message')
            );
            $actions .= '</div>';

            $this->dataTable->addRow(
                $slug,
                $event->getLocation(),
                $dateTime->toReadable(),
                $isPublishedState->toReadable(),
                $actions
            );
        }

        return $this->dataTable->get();
    }
}
