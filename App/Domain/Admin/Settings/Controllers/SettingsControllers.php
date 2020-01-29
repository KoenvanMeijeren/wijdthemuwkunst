<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Controllers;

use Domain\Admin\Settings\Actions\CreateSettingAction;
use Domain\Admin\Settings\Actions\DestroySettingAction;
use Domain\Admin\Settings\Actions\UpdateSettingAction;
use Domain\Admin\Settings\Models\Setting;
use Domain\Admin\Settings\ViewModels\EditViewModel;
use Domain\Admin\Settings\ViewModels\IndexViewModel;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class SettingsControllers
{
    private Setting $setting;

    private string $baseViewPath = 'Admin/Settings/Views/';
    private string $redirectBack = '/admin/settings';

    public function __construct()
    {
        $this->setting = new Setting();
    }

    public function index(): DomainView
    {
        $settings = new IndexViewModel($this->setting->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('settings_title'),
                'settings' => $settings->getTable()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateSettingAction($this->setting);
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }

    public function edit(): DomainView
    {
        $settings = new IndexViewModel($this->setting->all());
        $setting = new EditViewModel(
            $this->setting->find($this->setting->getId())
        );

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('settings_title'),
                'settings' => $settings->getTable(),
                'setting' => $setting->get()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateSettingAction($this->setting);
        if ($update->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->edit();
    }

    public function destroy(): Redirect
    {
        $destroy = new DestroySettingAction($this->setting);
        $destroy->execute();

        return new Redirect($this->redirectBack);
    }
}
