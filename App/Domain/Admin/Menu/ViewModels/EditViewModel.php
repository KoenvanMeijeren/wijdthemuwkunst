<?php


namespace App\Domain\Admin\Menu\ViewModels;


use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?object $menuItem;
    private Session $session;

    public function __construct(?object $menuItem)
    {
        $this->menuItem = $menuItem;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     */
    public function get()
    {
        if ($this->menuItem === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('menu_item_does_not_exists')
            );

            return new Redirect('/admin/structure/menu');
        }

        return $this->menuItem;
    }
}
