<?php


namespace App\Domain\Admin\Debug\Src;


use Cake\Chronos\Chronos;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Src\Core\Cookie;
use Src\Session\Session;
use Src\Translation\Translation;
use Support\DataTable;
use Support\DateTime;

final class SuperGlobals
{
    public function getHeadersInformation(): string
    {
        $table = new DataTable();

        $table->addHead(
            Translation::get('table_row_header')
        );
        foreach (headers_list() as $value) {
            $table->addRow($value);
        }

        return $table->get('undefined');
    }

    public function getSessionSettingsInformation(): string
    {
        $table = new DataTable();
        $session = new Session();

        $table->addHead(
            Translation::get('table_row_key'),
            Translation::get('table_row_value')
        );
        foreach (session_get_cookie_params() as $key => $data) {
            if ($key === 'lifetime' && $session->exists('createdAt')) {
                $createdAt = new Chronos($session->get('createdAt'));
                $expiredAt = $createdAt->addSeconds($data);
                $lifetime = new Chronos();

                $table->addRow(
                    $key,
                    $lifetime->diffInMinutes($expiredAt) . ' minuten'
                );
            } elseif (is_bool($data)) {
                $table->addRow($key, $data ? 'true' : 'false');
            } else {
                $table->addRow(
                    $key,
                    $data
                );
            }
        }

        return $table->get('undefined');
    }

    public function getSessionInformation(): string
    {
        $session = new Session();
        $table = new DataTable();

        $table->addHead(
            Translation::get('table_row_key'),
            Translation::get('table_row_value')
        );
        foreach (array_keys($_SESSION) as $key) {
            if ($key === 'CSRF') {
                continue;
            }

            if ($key === 'createdAt') {
                $dateTime = new DateTime(new Chronos($session->get($key)));

                $table->addRow(
                    $key,
                    $dateTime->toDateTime()
                );
            } else {
                $table->addRow(
                    $key,
                    $session->get($key)
                );
            }
        }

        return $table->get('undefined');
    }

    public function getCookieInformation(): string
    {
        $cookie = new Cookie();
        $table = new DataTable();

        $table->addHead(
            Translation::get('table_row_key'),
            Translation::get('table_row_value')
        );
        foreach (array_keys($_COOKIE) as $key) {
            if ($key === $cookie->get('sessionName')
                && $cookie->exists($cookie->get('sessionName'))
            ) {
                $table->addRow(
                    'sessie cookie',
                    $_COOKIE[$cookie->get('sessionName')]
                );
            }

            try {
                $table->addRow(
                    $key,
                    $cookie->get($key)
                );
            } catch (WrongKeyOrModifiedCiphertextException $e) {
                $table->addRow(
                    $key,
                    $_COOKIE[$key]
                );
            }
        }

        return $table->get('undefined');
    }
}
