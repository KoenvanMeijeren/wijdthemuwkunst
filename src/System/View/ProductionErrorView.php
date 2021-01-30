<?php
declare(strict_types=1);

namespace System\View;

use Components\Env\Env;
use Components\Translation\TranslationOld;
use Components\View\View;
use Whoops\Handler\Handler;

/**
 * Provides a class for showing production error views.
 *
 * @package System\View
 */
final class ProductionErrorView extends Handler {

  /**
   * {@inheritDoc}
   */
  public function handle(): int {
    new View(Env::ERROR_PAGE, [
      'title' => TranslationOld::get('internal_server_error_title'),
      'description' => TranslationOld::get('internal_server_error_description'),
    ]);

    return Handler::QUIT;
  }

}
