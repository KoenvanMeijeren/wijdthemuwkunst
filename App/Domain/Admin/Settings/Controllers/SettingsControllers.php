<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Controllers;

use Domain\Admin\Settings\Actions\CreateBaseSettingAction;
use Domain\Admin\Settings\Actions\DestroySettingAction;
use Domain\Admin\Settings\Actions\UpdateBaseSettingAction;
use Domain\Admin\Settings\Models\Setting;
use Domain\Admin\Settings\ViewModels\EditViewModel;
use Domain\Admin\Settings\ViewModels\IndexViewModel;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class SettingsControllers
{
    private string $baseViewPath = 'Admin/Settings/Views/';
    private string $redirectBack = '/admin/settings';

    public function index(): DomainView
    {
        $setting = new Setting();
        $settings = new IndexViewModel($setting->all());

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('settings_title'),
            'settings' => $settings->getTable()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateBaseSettingAction();
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }

    public function edit(): DomainView
    {
        $setting = new Setting();
        $indexViewModel = new IndexViewModel($setting->all());
        $editViewModel = new EditViewModel($setting->find($setting->getId()));

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('settings_title'),
            'settings' => $indexViewModel->getTable(),
            'setting' => $editViewModel->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateBaseSettingAction();
        if ($update->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->edit();
    }

    public function destroy(): Redirect
    {
        $destroy = new DestroySettingAction();
        $destroy->execute();

        return new Redirect($this->redirectBack);
    }
}
