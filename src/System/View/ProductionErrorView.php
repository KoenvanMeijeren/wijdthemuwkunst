<?php
declare(strict_types=1);

namespace System\View;

use Components\Env\Env;
use Components\Translation\TranslationOld;
use Src\View\View;
use Whoops\Handler\Handler;

/**
 * Provides a class for showing production error views.
 *
 * @package src\View
 */
final class ProductionErrorView extends Handler {

  /**
   * Show the error page when the app is in production mode.
   *
   * @return int
   *   A handler may return nothing or a Handler::HANDLE_* constant.
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function handle(): int {
    new View(Env::ERROR_PAGE, [
      'title' => TranslationOld::get('internal_server_error_title'),
      'description' => TranslationOld::get('internal_server_error_description'),
    ]);

    return Handler::QUIT;
  }

}
