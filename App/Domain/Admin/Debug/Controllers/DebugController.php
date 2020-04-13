<?php
declare(strict_types=1);


namespace Domain\Admin\Debug\Controllers;

use App\Domain\Admin\Debug\Src\Logs;
use App\Domain\Admin\Debug\Src\PhpInfo;
use App\Domain\Admin\Debug\Src\SuperGlobals;
use Cake\Chronos\Chronos;
use Src\Core\Env;
use Src\Core\Request;
use Src\Translation\Translation;
use Src\View\DomainView;

final class DebugController
{
    private string $baseViewPath = 'Admin/Debug/Views/';

    public function application(): DomainView
    {
        $env = new Env();
        $phpInfo = new PhpInfo();
        $superGlobals = new SuperGlobals();

        return new DomainView($this->baseViewPath . 'application', [
            'title' => Translation::get('admin_reports_application_title'),
            'env' => $env->get(),
            'headerDataTable' => $superGlobals->getHeadersInformation(),
            'phpinfo' => $phpInfo->get(),
        ]);
    }

    public function logs(): DomainView
    {
        $request = new Request();
        $logs = new Logs();

        $date = $request->get('logDate');
        $arrayDate = explode('-', $date);
        if (!checkdate(
            (int)($arrayDate[1] ?? 0),
            (int)($arrayDate[0] ?? 0),
            (int)($arrayDate[2] ?? 0)
        )) {
            $date = new Chronos();
            $date = $date->toDateString();
        }

        return new DomainView($this->baseViewPath . 'logs', [
            'title' => Translation::get('admin_reports_logs_title'),
            'logs' => $logs->get($date),
        ]);
    }

    public function storage(): DomainView
    {
        $superGlobals = new SuperGlobals();

        return new DomainView($this->baseViewPath . 'storage', [
            'title' => Translation::get('admin_reports_storage_title'),
            'sessionSettingsTable' => $superGlobals->getSessionSettingsInformation(),
            'sessionDataTable' => $superGlobals->getSessionInformation(),
            'cookieDataTable' => $superGlobals->getCookieInformation(),
        ]);
    }
}
