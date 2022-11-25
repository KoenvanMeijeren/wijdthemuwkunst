<?php
declare(strict_types=1);

namespace Modules\Reports\Src;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;
use Components\SuperGlobals\Cookie\Cookie;
use Components\SuperGlobals\Request;
use Components\Translation\TranslationOld;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use System\DataTable\DataTable;

/**
 * Provides a class to get data from the super globals.
 *
 * @package Modules\Reports\Src
 */
final class SuperGlobals {

  /**
   * Constructs a new object.
   */
  public function __construct(
    protected readonly Request $request
  ) {}

  /**
   * Gets data from the headers.
   */
  public function getHeadersInformation(): string {
    $table = new DataTable();

    $table->addHead([TranslationOld::get('table_row_header'),]);
    foreach (headers_list() as $value) {
      $table->addRow([$value,]);
    }

    return $table->render('undefined');
  }

  /**
   * Gets data from the session settings.
   */
  public function getSessionSettingsInformation(): string {
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach (session_get_cookie_params() as $key => $data) {
      if ($key === 'lifetime' && $this->request->session->exists('createdAt')) {
        $createdAt = new Chronos($this->request->session->get('createdAt'));
        $expiredAt = $createdAt->addSeconds($data);
        $lifetime = new Chronos();

        $table->addRow([$key,
          $lifetime->diffInMinutes($expiredAt) . ' ' . TranslationOld::get('minutes'),
        ]);

        continue;
      }

      if (is_bool($data)) {
        $table->addRow([$key, $data ? 'true' : 'false',]);

        continue;
      }

      $table->addRow([$key, (string) $data,]);
    }

    return $table->render('undefined');
  }

  /**
   * Gets data from the session.
   */
  public function getSessionInformation(): string {
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach ($this->request->session->all() as $key => $item) {
      if ($key === 'CSRF') {
        continue;
      }

      if ($key === 'createdAt') {
        $dateTime = new DateTime(new Chronos($item));
        $table->addRow([$key, $dateTime->toDateTime()]);

        continue;
      }

      $table->addRow([$key, $item]);
    }

    return $table->render('undefined');
  }

  /**
   * Gets data from the cookies.
   */
  public function getCookieInformation(): string {
    $cookie = new Cookie();
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach (array_keys($this->request->cookie->all()) as $key) {
      $sessionName = $this->request->cookie->get('sessionName');
      if ($key === $sessionName && $cookie->exists($sessionName)) {
        $table->addRow(['sessie cookie', $sessionName,]);
        continue;
      }

      try {
        $table->addRow([$key, $cookie->get($key),]);
      }
      catch (WrongKeyOrModifiedCiphertextException $e) {
        $table->addRow([$key, $_COOKIE[$key],]);
      }
    }

    return $table->render('undefined');
  }

}
