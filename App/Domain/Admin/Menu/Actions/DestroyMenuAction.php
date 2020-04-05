<?php


namespace App\Domain\Admin\Menu\Actions;


use Src\State\State;
use Src\Translation\Translation;

final class DestroyMenuAction extends BaseMenuAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->menu->delete($this->menu->getId());

        if ($this->menu->find($this->menu->getId()) !== null) {
            $this->session->flash(State::SUCCESSFUL,
                sprintf(
                    Translation::get('menu_item_unsuccessful_deleted'),
                    $this->menuRepository->getTitle()
                )
            );

            return false;
        }

        $this->session->flash(State::SUCCESSFUL,
            sprintf(
                Translation::get('menu_item_successful_deleted'),
                $this->menuRepository->getTitle()
            )
        );

        return true;
    }

    protected function validate(): bool
    {
        return true;
    }
}
