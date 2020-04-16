<?php


namespace App\Domain\Admin\Event\ViewModels;


use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Event\Support\EventDatetimeConverter;
use App\Src\DataTable\DataTableBuilder;
use Src\Translation\Translation;
use Support\Resource;

final class ArchivedEventTable extends DataTableBuilder
{
    /**
     * @inheritDoc
     */
    protected function buildHead(): array
    {
        return [
            Translation::get('table_row_slug'),
            Translation::get('table_row_title'),
            Translation::get('table_row_location'),
            Translation::get('table_row_datetime'),
            Translation::get('table_row_edit'),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function buildRow(object $data): array
    {
        $event = new EventRepository($data);

        $dateTime = new EventDatetimeConverter($event->getDatetime());
        $slug = "<a href='/concerten/historie/concert/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

        return [
            $slug,
            $event->getTitle(),
            $event->getLocation(),
            $dateTime->toReadable(),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function buildRowActions(object $data): string
    {
        $event = new EventRepository($data);

        $actions = '<div class="table-edit-row flex">';
        $actions .= Resource::addTableButtonActionColumn(
            '/admin/content/events/event/activate/' . $event->getId(),
            'Activeren',
            'fas fa-history',
            'btn-success'
        );
        $actions .= Resource::addTableButtonActionColumn(
            '/admin/content/events/event/delete/' . $event->getId(),
            Translation::get('table_row_delete'),
            'fas fa-trash-alt',
            'btn-danger',
            Translation::get('delete_event_confirmation_message')
        );
        $actions .= '</div>';

        return $actions;
    }
}
