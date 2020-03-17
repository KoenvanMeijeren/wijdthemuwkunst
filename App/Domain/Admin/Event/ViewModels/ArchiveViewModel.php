<?php


namespace App\Domain\Admin\Event\ViewModels;


use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Event\Support\EventDatetimeConverter;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

class ArchiveViewModel
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
            Translation::get('table_row_title'),
            Translation::get('table_row_location'),
            Translation::get('table_row_datetime'),
            Translation::get('table_row_edit'),
            );

        foreach ($this->events as $singleEvent) {
            $event = new EventRepository($singleEvent);
            $dateTime = new EventDatetimeConverter(
                $event->getDatetime()
            );

            $slug = "<a href='/concert/historie/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

            $actions = '<div class="table-edit-row flex">';
            $actions .= Resource::addTableButtonActionColumn(
                '/admin/concert/activate/' . $event->getId(),
                'Activeren',
                'fas fa-history',
                'btn-success'
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
                $event->getTitle(),
                $event->getLocation(),
                $dateTime->toReadable(),
                $actions
            );
        }

        return $this->dataTable->get('archive-table');
    }
}
