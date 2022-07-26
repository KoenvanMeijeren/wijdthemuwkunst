<?php
declare(strict_types=1);

namespace Modules\Reports\Controllers;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTimeHelper;
use Components\Route\RouteGet;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use JetBrains\PhpStorm\Pure;
use Modules\Reports\Src\Logs;
use Modules\Reports\Src\PhpInfo;
use Modules\Reports\Src\SuperGlobals;
use System\Controller\ControllerBase;

/**
 * Provides a controller for reports.
 *
 * @package Modules\Reports\Controllers
 */
final class ReportsController extends ControllerBase {

  /**
   * {@inheritDoc}
   */
  #[Pure] public function __construct() {
    parent::__construct('Reports/Views/');
  }

  /**
   * Returns the application data view.
   */
  #[RouteGet(url: 'admin/reports/application', rights: RouteRights::DEVELOPER)]
  public function application(): ViewInterface {
    $phpInfo = new PhpInfo();
    $superGlobals = new SuperGlobals($this->request());

    return $this->view('application', [
      'title' => TranslationOld::get('admin_reports_application_title'),
      'env' => $this->env()->get()->value,
      'headerDataTable' => $superGlobals->getHeadersInformation(),
      'sessionSettingsTable' => $superGlobals->getSessionSettingsInformation(),
      'phpinfo' => $phpInfo->get(),
    ]);
  }

  /**
   * Returns the log data view.
   */
  #[RouteGet(url: 'admin/reports/logs', rights: RouteRights::DEVELOPER)]
  public function logs(): ViewInterface {
    $logs = new Logs();

    $date = $this->request()->query->get('date');
    if (!DateTimeHelper::isDate($date)) {
      $date = new Chronos();
      $date = $date->toDateString();
      $this->request()->query->save('date', $date);
    }

    return $this->view('logs', [
      'title' => TranslationOld::get('admin_reports_logs_title'),
      'logs' => $logs->get($date),
    ]);
  }

  /**
   * Returns the storage data view.
   */
  #[RouteGet(url: 'admin/reports/storage', rights: RouteRights::DEVELOPER)]
  public function storage(): ViewInterface {
    $superGlobals = new SuperGlobals($this->request());

    return $this->view('storage', [
      'title' => TranslationOld::get('admin_reports_storage_title'),
      'sessionDataTable' => $superGlobals->getSessionInformation(),
      'cookieDataTable' => $superGlobals->getCookieInformation(),
    ]);
  }

}
