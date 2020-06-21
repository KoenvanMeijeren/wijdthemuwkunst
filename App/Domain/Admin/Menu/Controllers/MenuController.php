<?php

namespace Domain\Admin\Menu\Controllers;

use Domain\Admin\Menu\Actions\CreateMenuAction;
use Domain\Admin\Menu\Actions\DestroyMenuAction;
use Domain\Admin\Menu\Actions\UpdateMenuAction;
use Domain\Admin\Menu\Models\Menu;
use Domain\Admin\Menu\ViewModels\EditViewModel;
use Domain\Admin\Menu\ViewModels\MenuTable;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 *
 */
final class MenuController extends AdminControllerBase {
  protected string $baseViewPath = 'Admin/Menu/Views/';

  private Menu $menu;
  private string $redirectBack = '/admin/structure/menu';

  /**
   *
   */
  public function __construct() {
    parent::__construct();

    $this->menu = new Menu();
  }

  /**
   *
   */
  public function index(): ViewInterface {
    $menuTable = new MenuTable($this->menu->getAll());

    return $this->view('index', [
      'title' => Translation::get('menu_title'),
      'menu_items' => $menuTable->get(),
    ]);
  }

  /**
   *
   */
  public function create(): ViewInterface {
    $menuTable = new MenuTable($this->menu->getAll());

    return $this->view('index', [
      'title' => Translation::get('menu_title'),
      'menu_items' => $menuTable->get(),
      'create_menu_item' => TRUE,
    ]);
  }

  /**
   * @return \Src\Response\Redirect|DomainView
   */
  public function store() {
    $create = new CreateMenuAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

  /**
   *
   */
  public function edit(): ViewInterface {
    $menuItem = new EditViewModel(
          $this->menu->find($this->menu->getId())
      );
    $menuTable = new MenuTable($this->menu->getAll());

    return $this->view('index', [
      'title' => Translation::get('menu_title'),
      'menu_items' => $menuTable->get(),
      'menu_item' => $menuItem->get(),
    ]);
  }

  /**
   * @return \Src\Response\Redirect|DomainView
   */
  public function update() {
    $update = new UpdateMenuAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   *
   */
  public function destroy(): Redirect {
    $destroy = new DestroyMenuAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}
