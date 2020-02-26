<?php


namespace App\Domain\Admin\Event\ViewModels;

use App\Domain\Admin\Event\Repositories\EventRepository;
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
            Translation::get('table_row_title'),
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

            if (!$event->isPublished()) {
                $this->dataTable->addClasses('row-warning');
            }

            $slug = "<a href='/concert/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

            $this->dataTable->addRow(
                $slug,
                $event->getTitle(),
                $event->getLocation(),
                $event->getDatetime(),
                $isPublishedState->toReadable(),
                Resource::addTableEditColumn(
                    '/admin/concert/edit/' . $event->getId(),
                    '/admin/concert/delete/' . $event->getId(),
                    Translation::get('delete_event_confirmation_message')
                )
            );
        }

        return $this->dataTable->get();
    }
}
