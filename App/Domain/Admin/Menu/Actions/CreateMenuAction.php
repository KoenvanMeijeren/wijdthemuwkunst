<?php


namespace App\Domain\Admin\Menu\Actions;


use Src\State\State;
use Src\Translation\Translation;

final class CreateMenuAction extends BaseMenuAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $menuItem = $this->menu->firstOrCreate($this->attributes);

        if ($menuItem === null) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('menu_item_unsuccessful_created'),
                    $this->title
                )
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('menu_item_successful_created'),
                $this->title
            )
        );

        return true;
    }
}
