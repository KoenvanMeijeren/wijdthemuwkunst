<?php
declare(strict_types=1);


namespace Domain\Admin\Reports\Controllers;

use App\Domain\Admin\Reports\Src\Logs;
use App\Domain\Admin\Reports\Src\PhpInfo;
use App\Domain\Admin\Reports\Src\SuperGlobals;
use Cake\Chronos\Chronos;
use Src\Core\Env;
use Src\Core\Request;
use Src\Translation\Translation;
use Src\View\DomainView;

final class ReportsController
{
    private string $baseViewPath = 'Admin/Reports/Views/';

    public function application(): DomainView
    {
        $env = new Env();
        $phpInfo = new PhpInfo();
        $superGlobals = new SuperGlobals();

        return new DomainView($this->baseViewPath . 'application', [
            'title' => Translation::get('admin_reports_application_title'),
            'env' => $env->get(),
            'headerDataTable' => $superGlobals->getHeadersInformation(),
            'sessionSettingsTable' => $superGlobals->getSessionSettingsInformation(),
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
            'sessionDataTable' => $superGlobals->getSessionInformation(),
            'cookieDataTable' => $superGlobals->getCookieInformation(),
        ]);
    }
}
