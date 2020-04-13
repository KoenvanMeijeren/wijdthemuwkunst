<?php


namespace App\Domain\Admin\Text\Controllers;


use App\Domain\Admin\Text\Actions\CreateTextAction;
use App\Domain\Admin\Text\Actions\DeleteTextAction;
use App\Domain\Admin\Text\Actions\UpdateTextAction;
use App\Domain\Admin\Text\Models\Text;
use App\Domain\Admin\Text\ViewModels\EditViewModel;
use App\Domain\Admin\Text\ViewModels\TextTable;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class TextController
{
    private Text $text;

    private string $baseViewPath = 'Admin/Text/Views/';
    private string $redirectBack = '/admin/texts';

    public function __construct()
    {
        $this->text = new Text();
    }

    public function index(): DomainView
    {
        $textTable = new TextTable($this->text->all());

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('texts_title'),
            'texts' => $textTable->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateTextAction();
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }

    public function edit(): DomainView
    {
        $textTable = new TextTable($this->text->all());
        $text = new EditViewModel(
            $this->text->find($this->text->getId())
        );

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('texts_title'),
            'texts' => $textTable->get(),
            'text' => $text->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdateTextAction();
        if ($update->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->edit();
    }

    public function destroy(): Redirect
    {
        $destroy = new DeleteTextAction();
        $destroy->execute();

        return new Redirect($this->redirectBack);
    }
}
