<?php
declare(strict_types=1);


namespace Domain\Admin\Settings\ViewModels;

use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?object $setting;
    private Session $session;

    public function __construct(?object $setting)
    {
        $this->setting = $setting;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     */
    public function get()
    {
        if ($this->setting === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_does_not_exists')
            );

            return new Redirect('/admin/settings');
        }

        return $this->setting;
    }
}
