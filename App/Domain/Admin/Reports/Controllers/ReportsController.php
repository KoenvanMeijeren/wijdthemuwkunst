<?php

declare(strict_types=1);


namespace Domain\Admin\Reports\Controllers;

use Cake\Chronos\Chronos;
use Domain\Admin\Reports\Src\Logs;
use Domain\Admin\Reports\Src\PhpInfo;
use Domain\Admin\Reports\Src\SuperGlobals;
use Src\Core\Env;
use Src\Core\Request;
use Src\Translation\Translation;
use Src\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 *
 */
final class ReportsController extends AdminControllerBase {
  protected string $baseViewPath = 'Admin/Reports/Views/';

  /**
   *
   */
  public function application(): ViewInterface {
    $env = new Env();
    $phpInfo = new PhpInfo();
    $superGlobals = new SuperGlobals();

    return $this->view('application', [
      'title' => Translation::get('admin_reports_application_title'),
      'env' => $env->get(),
      'headerDataTable' => $superGlobals->getHeadersInformation(),
      'sessionSettingsTable' => $superGlobals->getSessionSettingsInformation(),
      'phpinfo' => $phpInfo->get(),
    ]);
  }

  /**
   *
   */
  public function logs(): ViewInterface {
    $request = new Request();
    $logs = new Logs();

    $date = $request->get('date');
    $arrayDate = explode('-', $date);
    if (!checkdate(
          (int) ($arrayDate[1] ?? 0),
          (int) ($arrayDate[0] ?? 0),
          (int) ($arrayDate[2] ?? 0)
      )) {
      $date = new Chronos();
      $date = $date->toDateString();
    }

    return $this->view('logs', [
      'title' => Translation::get('admin_reports_logs_title'),
      'logs' => $logs->get($date),
    ]);
  }

  /**
   *
   */
  public function storage(): ViewInterface {
    $superGlobals = new SuperGlobals();

    return $this->view('storage', [
      'title' => Translation::get('admin_reports_storage_title'),
      'sessionDataTable' => $superGlobals->getSessionInformation(),
      'cookieDataTable' => $superGlobals->getCookieInformation(),
    ]);
  }

}
