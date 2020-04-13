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

    public function index(): DomainView
    {
        $request = new Request();
        $env = new Env();
        $logs = new Logs();
        $phpInfo = new PhpInfo();
        $superGlobals = new SuperGlobals();

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

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_debug_title'),
                'env' => $env->get(),
                'headerDataTable' => $superGlobals->getHeadersInformation(),
                'sessionSettingsTable' => $superGlobals->getSessionSettingsInformation(),
                'sessionDataTable' => $superGlobals->getSessionInformation(),
                'cookieDataTable' => $superGlobals->getCookieInformation(),
                'logs' => $logs->get($date),
                'phpinfo' => $phpInfo->get(),
            ]
        );
    }
}
