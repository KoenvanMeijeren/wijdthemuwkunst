<?php


namespace App\Domain\Admin\Event\Actions;


use App\Domain\Admin\Event\Models\Event;
use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\File\Actions\SaveFileAction;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\Validate\form\FormValidator;

abstract class EventAction extends FormAction
{
    protected Event $event;
    protected EventRepository $eventRepository;
    protected Session $session;

    protected int $id;
    protected int $bannerID = 0;
    protected int $thumbnailID = 0;
    protected string $title;
    protected string $content;
    protected string $datetime;
    protected string $location;

    protected array $attributes = [];

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->session = new Session();
        $request = new Request();

        $this->eventRepository = new EventRepository(
            $this->event->find($this->event->getId())
        );
        $this->id = $this->eventRepository->getId();

        $this->title = $request->post('title');
        $this->content = $request->post('content');
        $this->datetime = $request->post('datetime');
        $this->location = $request->post('location');

        if ($request->post('thumbnail') !== '') {
            $thumbnail = json_decode(
                parseHtmlEntities($request->post('thumbnail')),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            if (array_key_exists('location', $thumbnail)) {
                $saveThumbnail = new SaveFileAction($thumbnail['location']);
                $saveThumbnail->execute();

                $this->thumbnailID = $saveThumbnail->getFileId();
            }
        }

        if ($request->post('banner') !== '') {
            $banner = json_decode(
                parseHtmlEntities($request->post('banner')),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            if (array_key_exists('location', $banner)) {
                $saveBanner = new SaveFileAction($banner['location']);
                $saveBanner->execute();

                $this->bannerID = $saveBanner->getFileId();
            }
        }

        $this->prepare();
    }

    protected function prepare(): void
    {
        $this->attributes = [
            'event_title' => $this->title,
            'event_content' => $this->content,
            'event_date' => $this->datetime,
            'event_location' => $this->location,
        ];

        if ($this->thumbnailID !== 0) {
            $this->attributes['event_thumbnail_ID'] = (string) $this->thumbnailID;
        }

        if ($this->bannerID !== 0) {
            $this->attributes['event_banner_ID'] = (string) $this->bannerID;
        }
    }

    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->title, 'Concert titel')->isRequired();
        $validator->input($this->content, 'Concert content')->isRequired();
        $validator->input($this->datetime, 'Concert datum')->isRequired();
        $validator->input($this->location, 'Concert locatie')->isRequired();

        return $validator->handleFormValidation();
    }
}
