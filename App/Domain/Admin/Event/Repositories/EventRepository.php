<?php


namespace App\Domain\Admin\Event\Repositories;


use App\Domain\Admin\File\Models\File;

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
}
