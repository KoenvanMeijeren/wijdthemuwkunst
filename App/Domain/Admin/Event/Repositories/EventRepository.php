<?php


namespace App\Domain\Admin\Event\Repositories;

use App\Domain\Admin\Event\Support\EventDatetimeConverter;
use App\Domain\Admin\File\Models\File;
use Cake\Chronos\Chronos;
use Support\DateTime;

final class EventRepository
{
    protected int $id;
    protected string $banner;
    protected string $thumbnail;
    protected string $title;
    protected string $content;
    protected string $datetime;
    protected string $location;
    protected bool $isPublished;
    protected bool $isDeleted;

    private int $slugId;
    private string $slug;
    private bool $slugIsDeleted;

    public function __construct(?object $event)
    {
        $file = new File();
        $thumbnail = $file->find((int) ($event->event_thumbnail_ID ?? '0'));
        $banner = $file->find((int) ($event->event_banner_ID ?? '0'));

        $this->id = (int) ($event->event_ID ?? '0');
        $this->thumbnail = $thumbnail->file_path ?? '';
        $this->banner = $banner->file_path ?? '';
        $this->title = $event->event_title ?? '';
        $this->content = $event->event_content ?? '';
        $this->location = $event->event_location ?? '';
        $this->datetime = $event->event_date ?? '';
        $this->isPublished = (bool) ($event->event_is_published ?? '0');
        $this->isDeleted = (bool) ($event->event_is_deleted ?? '0');

        $this->slugId = (int) ($event->slug_ID ?? '0');
        $this->slug = $event->slug_name ?? '';
        $this->slugIsDeleted = (bool) ($event->slug_is_deleted ?? '0');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDatetime(): string
    {
        return $this->datetime;
    }

    public function getReadableDatetime(): string
    {
        $datetime = new EventDatetimeConverter($this->getDatetime());

        return $datetime->toReadable();
    }

    public function getDayNumber(): string
    {
        $datetime = new DateTime(new Chronos($this->getDatetime()));

        return (string) $datetime->toDayNumber();
    }

    public function getDate(): string
    {
        $datetime = new DateTime(
            new Chronos($this->getDatetime())
        );

        return $datetime->toFormattedDate();
    }

    public function getShortDate(): string
    {
        $datetime = new DateTime(new Chronos($this->getDatetime()));

        return $datetime->toShortMonth();
    }

    public function getTime(): string
    {
        $datetime = new Chronos($this->getDatetime());

        return $datetime->toTimeString();
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function getSlugId(): int
    {
        return $this->slugId;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function isSlugIsDeleted(): bool
    {
        return $this->slugIsDeleted;
    }
}
