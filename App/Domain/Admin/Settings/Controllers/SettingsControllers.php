<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\Controllers;

use App\System\Controller\AdminControllerBase;
use Domain\Admin\Settings\Actions\CreateBaseSettingAction;
use Domain\Admin\Settings\Actions\DestroySettingAction;
use Domain\Admin\Settings\Actions\UpdateBaseSettingAction;
use Domain\Admin\Settings\Models\Setting;
use Domain\Admin\Settings\ViewModels\EditViewModel;
use Domain\Admin\Settings\ViewModels\SettingTable;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class SettingsControllers extends AdminControllerBase
{
    protected string $baseViewPath = 'Admin/Settings/Views/';

    private string $redirectBack = '/admin/configuration/settings';

    public function index(): DomainView
    {
        $setting = new Setting();
        $settingTable = new SettingTable($setting->all());

        return $this->view('index', [
            'title' => Translation::get('settings_title'),
            'settings' => $settingTable->get()
        ]);
    }

    public function create(): DomainView
    {
        $setting = new Setting();
        $settingTable = new SettingTable($setting->all());

        return $this->view('index', [
            'title' => Translation::get('settings_title'),
            'settings' => $settingTable->get(),
            'createSetting' => true,
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
        $settingTable = new SettingTable($setting->all());
        $editViewModel = new EditViewModel($setting->find($setting->getId()));

        return $this->view('index', [
            'title' => Translation::get('settings_title'),
            'settings' => $settingTable->get(),
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
