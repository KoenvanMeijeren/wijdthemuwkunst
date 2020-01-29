<?php
declare(strict_types=1);


namespace Src\View;

use Src\Core\Env;
use Src\Exceptions\Basic\InvalidKeyException;
use Src\Translation\Translation;
use Whoops\Handler\Handler;

final class ProductionErrorView extends Handler
{
    /**
     * Show the error page when the app is in production mode
     *
     * @return int A handler may return nothing,
     * or a Handler::HANDLE_* constant
     * @throws InvalidKeyException
     */
    public function handle(): int
    {
        new View(Env::ERROR_PAGE, [
            'title' => Translation::get('internal_server_error_title'),
            'description' => Translation::get('internal_server_error_description')
        ]);

        return Handler::QUIT;
    }
}
