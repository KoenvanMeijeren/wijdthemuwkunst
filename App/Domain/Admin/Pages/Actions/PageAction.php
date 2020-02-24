<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use App\Domain\Admin\File\Actions\SaveFileAction;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\Repositories\SlugRepository;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

abstract class PageAction extends FormAction
{
    protected Slug $slug;
    protected Page $page;
    protected PageRepository $pageRepository;
    protected Session $session;

    protected int $id;
    protected int $bannerID = 0;
    protected int $thumbnailID = 0;
    protected string $title;
    protected string $url;
    protected int $inMenu;
    protected string $content;

    protected array $attributes = [];

    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->slug = new Slug();
        $this->session = new Session();
        $request = new Request();

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

        $this->title = $request->post('title');
        $this->url = $this->slug->parse($request->post('slug'));
        $this->inMenu = (int)$request->post('pageInMenu');
        $this->content = $request->post('content');

        $this->pageRepository = new PageRepository(
            $this->page->find($this->page->getId())
        );
        $this->id = $this->pageRepository->getId();

        $this->prepare();
    }

    protected function prepare(): void
    {
        $this->attributes = [
            'page_slug_ID' => (string) $this->getSlugId(),
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ];

        if ($this->thumbnailID !== 0) {
            $this->attributes['page_thumbnail_ID'] = (string) $this->thumbnailID;
        }

        if ($this->bannerID !== 0) {
            $this->attributes['page_banner_ID'] = (string) $this->bannerID;
        }

        if ($this->inMenu === Page::PAGE_STATIC) {
            $this->attributes['page_is_published'] = '1';
        }
    }

    protected function getSlugId(): int
    {
        $slugRepository = new SlugRepository(
            $this->slug->firstOrCreate([
                'slug_name' => $this->url
            ])
        );

        return $slugRepository->getId();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->title, 'Title')
            ->isRequired();

        if ($this->url !== $this->pageRepository->getSlug()) {
            $validator->input($this->url, 'Slug')
                ->isRequired()
                ->isUnique(
                    $this->page->getBySlug($this->url),
                    sprintf(
                        Translation::get('page_already_exists'),
                        $this->url
                    )
                );
        }

        $validator->input((string)$this->inMenu, 'Zichtbaarheid van de pagina')
            ->isRequired()
            ->isInArray(
                (string)$this->inMenu,
                [
                    (string) Page::PAGE_PUBLIC_IN_MENU,
                    (string) Page::PAGE_NOT_IN_MENU,
                    (string) Page::PAGE_STATIC,
                ]
            );

        $validator->input($this->content, 'Pagina content')
            ->isRequired();

        return $validator->handleFormValidation();
    }
}
