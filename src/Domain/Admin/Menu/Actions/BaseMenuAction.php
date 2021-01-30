<?php

declare(strict_types=1);

namespace Domain\Admin\Menu\Actions;

use Components\Actions\FormAction;
use Components\Translation\TranslationOld;
use Domain\Admin\Menu\Models\Menu;
use Domain\Admin\Menu\Repositories\MenuRepository;
use Domain\Admin\Pages\Models\Slug;
use Domain\Admin\Pages\Repositories\SlugRepository;
use Src\Session\Session;
use Components\Validate\form\FormValidator;
use System\Request;

/**
 *
 */
abstract class BaseMenuAction extends FormAction {
  protected Slug $slug;
  protected Menu $menu;
  protected MenuRepository $menuRepository;
  protected Session $session;
  protected FormValidator $validator;

  protected int $id;
  protected string $url;
  protected string $title;
  protected int $weight;

  protected array $attributes = [];

  /**
   *
   */
  public function __construct() {
    $this->menu = new Menu();
    $this->slug = new Slug();
    $this->session() = new Session();
    $this->validator = new FormValidator();
    $request = new Request();

    $this->url = $this->slug->parse($request->post('slug'));
    $this->title = $request->post('title');
    $this->weight = (int) $request->post('weight');

    $this->menuRepository = new MenuRepository(
          $this->menu->find($this->menu->getId())
      );
    $this->id = $this->menuRepository->getId();

    $this->attributes = [
      $this->menu->foreignKey => (string) $this->getSlugId(),
      $this->menu->titleKey => $this->title,
      $this->menu->weightKey => (string) $this->weight,
    ];
  }

  /**
   *
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
   *
   */
  protected function validate(): bool {
    $this->validator->input($this->url, TranslationOld::get('url'))->isRequired();
    $this->validator->input($this->title, TranslationOld::get('title'))->isRequired();
    $this->validator->input($this->weight, TranslationOld::get('weight'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
