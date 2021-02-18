<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Components\Actions\FormAction;
use Components\Translation\TranslationOld;
use Modules\File\Actions\SaveFileAction;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\Repositories\SlugRepository;
use Components\Validate\FormValidator;

/**
 *
 */
abstract class BasePageAction extends FormAction {

  protected Slug $slug;
  protected Page $page;
  protected PageRepository $pageRepository;
  protected FormValidator $validator;

  protected int $bannerID = 0;
  protected int $thumbnailID = 0;
  protected string $title;
  protected string $url;
  protected int $inMenu;
  protected string $content;

  protected array $attributes = [];

  /**
   *
   */
  public function __construct() {
    $this->slug = new Slug();
    $this->page = new Page();
    $this->pageRepository = new PageRepository(
          $this->page->find($this->page->getId())
      );
    $this->validator = new FormValidator();

    $this->thumbnailID = $this->getFileId($this->request()->post('thumbnail'));
    $this->bannerID = $this->getFileId($this->request()->post('banner'));
    $this->title = $this->request()->post('title');
    $this->url = $this->slug->parse(
      $this->request()->post('slug', $this->pageRepository->getSlug())
      );
    $this->inMenu = (int) $this->request()->post(
          'pageInMenu',
          (string) $this->pageRepository->getInMenu()
      );
    $this->content = $this->request()->post('content');

    $this->prepareAttributes();
  }

  /**
   * Prepare the attributes.
   */
  protected function prepareAttributes(): void {
    $this->attributes = [
      'page_slug_ID' => (string) $this->getSlugId(),
      'page_title' => $this->title,
      'page_content' => $this->content,
      'page_in_menu' => (string) $this->inMenu,
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

  /**
   * Get the first record matching the attributes or create it and return the id.
   */
  protected function getSlugId(): int {
    $slugRepository = new SlugRepository(
          $this->slug->firstOrCreate([
            'slug_name' => $this->url,
          ])
      );

    return $slugRepository->getId();
  }

  /**
   * Get the location of the file, save it and return the id.
   */
  protected function getFileId(string $fileLocation): int {
    if ($fileLocation === '') {
      return 0;
    }

    $fileLocation = json_decode(
          html_entities_decode($fileLocation),
          TRUE,
          512,
          JSON_THROW_ON_ERROR
      );

    if (!array_key_exists('location', $fileLocation)) {
      return 0;
    }

    $saveFile = new SaveFileAction($fileLocation['location']);
    $saveFile->execute();

    return $saveFile->getEntityId();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $this->validator->input($this->title, TranslationOld::get('title'))
      ->isRequired();

    if ($this->url !== $this->pageRepository->getSlug()) {
      $this->validator->input($this->url, TranslationOld::get('slug'))
        ->isRequired()
        ->isUnique(
                $this->page->getBySlug($this->url),
                sprintf(
                    TranslationOld::get('page_already_exists'),
                    $this->url
                )
            );
    }

    $this->validator->input((string) $this->inMenu, TranslationOld::get('page_visibility'))
      ->isRequired()
      ->isInArray(
              (string) $this->inMenu,
              [
                (string) Page::PAGE_NORMAL,
                (string) Page::PAGE_STATIC,
              ]
          );

    $this->validator->input($this->content, TranslationOld::get('page_content'))
      ->isRequired();

    return $this->validator->handleFormValidation();
  }

}
