<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

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
    protected string $title;
    protected string $url;
    protected int $inMenu;
    protected string $content;

    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->slug = new Slug();
        $this->session = new Session();
        $request = new Request();

        $this->title = $request->post('title');
        $this->url = $this->slug->parse($request->post('slug'));
        $this->inMenu = (int)$request->post('pageInMenu');
        $this->content = $request->post('content');

        $this->pageRepository = new PageRepository(
            $this->page->find($this->page->getId())
        );
        $this->id = $this->pageRepository->getId();
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
                (string)$this->inMenu, [
                    (string) Page::PAGE_PUBLIC_IN_MENU,
                    (string) Page::PAGE_NOT_IN_MENU,
                    (string) Page::PAGE_STATIC,
                ]);

        $validator->input($this->content, 'Pagina content')
            ->isRequired();

        return $validator->handleFormValidation();
    }
}
