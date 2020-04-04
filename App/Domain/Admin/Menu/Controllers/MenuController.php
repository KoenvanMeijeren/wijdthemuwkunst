<?php


namespace App\Domain\Admin\Menu\Controllers;


use App\Domain\Admin\Menu\Actions\CreateMenuAction;
use App\Domain\Admin\Menu\Actions\DestroyMenuAction;
use App\Domain\Admin\Menu\Actions\UpdateMenuAction;
use App\Domain\Admin\Menu\Models\Menu;
use App\Domain\Admin\Menu\ViewModels\EditViewModel;
use App\Domain\Admin\Menu\ViewModels\IndexViewModel;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class MenuController
{
    private Menu $menu;

    private string $baseViewPath = 'Admin/Menu/Views/';
    private string $redirectBack = '/admin/menu';

    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function index(): DomainView
    {
        $menu = new IndexViewModel($this->menu->getAll());

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('menu_title'),
            'menu_items' => $menu->getTable()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateMenuAction();
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }

    public function edit(): DomainView
    {
        $menuItem = new EditViewModel(
            $this->menu->find($this->menu->getId())
        );
        $menuItems = new IndexViewModel($this->menu->getAll());

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('menu_title'),
            'menu_items' => $menuItems->getTable(),
            'menu_item' => $menuItem->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateMenuAction();
        if ($update->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->edit();
    }

    public function destroy(): Redirect
    {
        $destroy = new DestroyMenuAction();
        $destroy->execute();

        return new Redirect($this->redirectBack);
    }
}
