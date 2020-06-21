<?php

namespace Domain\Admin\Text\Controllers;

use Domain\Admin\Text\Actions\CreateTextAction;
use Domain\Admin\Text\Actions\DeleteTextAction;
use Domain\Admin\Text\Actions\UpdateTextAction;
use Domain\Admin\Text\Models\Text;
use Domain\Admin\Text\ViewModels\EditViewModel;
use Domain\Admin\Text\ViewModels\TextTable;
use Src\Core\Redirect;
use Src\Translation\Translation;
use Src\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 *
 */
final class TextController extends AdminControllerBase {
  protected string $baseViewPath = 'Admin/Text/Views/';

  private Text $text;
  private string $redirectBack = '/admin/configuration/texts';

  /**
   *
   */
  public function __construct() {
    parent::__construct();

    $this->text = new Text();
  }

  /**
   *
   */
  public function index(): ViewInterface {
    $textTable = new TextTable($this->text->all());

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
    ]);
  }

  /**
   *
   */
  public function create(): ViewInterface {
    $textTable = new TextTable($this->text->all());

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
      'createText' => TRUE,
    ]);
  }

  /**
   * @return \Src\Core|DomainView
   */
  public function store() {
    $create = new CreateTextAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

  /**
   *
   */
  public function edit(): ViewInterface {
    $textTable = new TextTable($this->text->all());
    $text = new EditViewModel(
          $this->text->find($this->text->getId())
      );

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
      'text' => $text->get(),
    ]);
  }

  /**
   * @return \Src\Core|DomainView
   */
  public function update() {
    $update = new UpdateTextAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   *
   */
  public function destroy(): Redirect {
    $destroy = new DeleteTextAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}
