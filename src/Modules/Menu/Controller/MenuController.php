<?php
declare(strict_types=1);

namespace Modules\Menu\Controller;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Modules\Menu\Actions\CreateMenuAction;
use Modules\Menu\Actions\DeleteMenuAction;
use Modules\Menu\Actions\UpdateMenuAction;
use Components\View\ViewInterface;
use Modules\Menu\Entity\Menu;
use Modules\Menu\Entity\MenuInterface;
use Modules\Menu\Entity\MenuTable;
use System\Entity\EntityControllerBase;
use System\StateInterface;

/**
 * Provides the controller for the menu entity.
 *
 * @package Modules\Menu\Controller
 */
final class MenuController extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/structure/menu';

  /**
   * MenuController constructor.
   */
  public function __construct() {
    parent::__construct(entityClass: Menu::class, baseViewPath: 'Menu/Views/');
  }


  /**
   * Returns all menu items.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function index(): ViewInterface {
    $menuTable = new MenuTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('menu_title'),
      'menu_items' => $menuTable->get(),
    ]);
  }

  /**
   * Returns the view for creating Menus.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  public function create(): ViewInterface {
    $menuTable = new MenuTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('menu_title'),
      'menu_items' => $menuTable->get(),
      'create_menu_item' => TRUE,
    ]);
  }

  /**
   * Stores the Menu in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function store(): ViewInterface|Redirect {
    $create = new CreateMenuAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   * Returns an edit view for Menus.
   *
   * @return \Components\Header\Redirect|ViewInterface
   *   The view.
   */
  public function edit(): ViewInterface|Redirect {
    $menuTable = new MenuTable($this->repository->all());
    /** @var MenuInterface $menu */
    $menu = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if ($menu === NULL) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('menu_item_does_not_exists'));

      return new Redirect($this->redirectBack);
    }

    return $this->view('index', [
      'title' => TranslationOld::get('menu_title'),
      'menu_items' => $menuTable->get(),
      'menu_item' => $menu,
    ]);
  }

  /**
   * Updates the Menu in the database.
   *
   * @return \Components\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function update(): ViewInterface|Redirect {
    $update = new UpdateMenuAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   * Destroys a Menu in the database.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  public function destroy(): Redirect {
    $destroy = new DeleteMenuAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}
