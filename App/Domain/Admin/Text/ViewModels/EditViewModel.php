<?php


namespace App\Domain\Admin\Text\ViewModels;


use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?object $text;
    private Session $session;

    public function __construct(?object $text)
    {
        $this->text = $text;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     */
    public function get()
    {
        if ($this->text === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('text_does_not_exists')
            );

            return new Redirect('/admin/configuration/texts');
        }

        return $this->text;
    }
}
