<?php
declare(strict_types=1);

namespace Modules\Reports\Src;

use Cake\Chronos\Chronos;
use Components\ComponentsTrait;
use Components\SuperGlobals\Cookie\Cookie;
use Components\Translation\TranslationOld;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Components\Datetime\DateTime;
use System\DataTable\DataTable;

/**
 * Provides a class to get data from the super globals.
 *
 * @package Modules\Reports\Src
 */
final class SuperGlobals {

  use ComponentsTrait;

  /**
   * Gets data from the headers.
   *
   * @return string
   *   The headers data.
   */
  public function getHeadersInformation(): string {
    $table = new DataTable();

    $table->addHead([TranslationOld::get('table_row_header'),]);
    foreach (headers_list() as $value) {
      $table->addRow([$value,]);
    }

    return $table->get('undefined');
  }

  /**
   * Gets data from the session settings.
   *
   * @return string
   *   The session settings data.
   */
  public function getSessionSettingsInformation(): string {
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach (session_get_cookie_params() as $key => $data) {
      if ($key === 'lifetime' && $this->session()->exists('createdAt')) {
        $createdAt = new Chronos($this->session()->get('createdAt'));
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

    return $table->get('undefined');
  }

  /**
   * Gets data from the session.
   *
   * @return string
   *   The session data.
   */
  public function getSessionInformation(): string {
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach (array_keys($_SESSION) as $key) {
      if ($key === 'CSRF') {
        continue;
      }

      if ($key === 'createdAt') {
        $dateTime = new DateTime(new Chronos($this->session()->get($key)));
        $table->addRow([$key, $dateTime->toDateTime(),]);

        continue;
      }

      $table->addRow([$key, $this->session()->get($key),]);
    }

    return $table->get('undefined');
  }

  /**
   * Gets data from the cookies.
   *
   * @return string
   *   The cookies data.
   */
  public function getCookieInformation(): string {
    $cookie = new Cookie();
    $table = new DataTable();

    $table->addHead([
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
    ]);
    foreach (array_keys($_COOKIE) as $key) {
      if ($key === $cookie->get('sessionName')
        && $cookie->exists($cookie->get('sessionName'))) {
        $table->addRow([
          'sessie cookie',
          $_COOKIE[$cookie->get('sessionName')],
        ]);

        continue;
      }

      try {
        $table->addRow([$key, $cookie->get($key),]);
      }
      catch (WrongKeyOrModifiedCiphertextException $e) {
        $table->addRow([$key, $_COOKIE[$key],]);
      }
    }

    return $table->get('undefined');
  }

}
