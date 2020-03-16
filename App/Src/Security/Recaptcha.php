<?php

declare(strict_types=1);

namespace Src\Security;

use ReCaptcha\ReCaptcha as GoogleRecaptcha;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

final class Recaptcha
{
    private GoogleRecaptcha $recaptcha;
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->recaptcha = new GoogleRecaptcha(
            $this->request->env('recaptcha_secret_key')
        );
    }

    public function validate(): bool
    {
        $response = $this->recaptcha
            ->verify(
                $this->request->post('g-recaptcha-response'),
                $this->request->server(Request::USER_IP_ADDRESS)
            );

        if ($response->isSuccess()) {
            return true;
        }

        $session = new Session();
        $session->flash(
            State::FAILED,
            Translation::get('failed_recaptcha_check_message')
        );

        return false;
    }
}
