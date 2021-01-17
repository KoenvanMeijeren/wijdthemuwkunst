<?php

namespace Domain\Admin\Text\Controllers;

use Components\Header\Redirect;
use Domain\Admin\Text\Actions\CreateTextAction;
use Domain\Admin\Text\Actions\DeleteTextAction;
use Domain\Admin\Text\Actions\UpdateTextAction;
use Domain\Admin\Text\Entity\Text;
use Domain\Admin\Text\Entity\TextRepositoryInterface;
use Domain\Admin\Text\Entity\TextTable;
use Src\Translation\Translation;
use Src\View\ViewInterface;
use System\Controller\AdminControllerBase;
use System\StateInterface;

/**
 * Provides a controller for maintaining the texts.
 *
 * @package Domain\Admin\Text\Controllers
 */
final class TextController extends AdminControllerBase {

  /**
   * The base path to the views directory.
   *
   * @var string
   */
  protected string $baseViewPath = 'Admin/Text/Views/';

  /**
   * The text entity repository definition.
   *
   * @var \Domain\Admin\Text\Entity\TextRepositoryInterface
   */
  protected TextRepositoryInterface $textRepository;

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/configuration/texts';

  /**
   * TextController constructor.
   */
  public function __construct() {
    parent::__construct();

    $storage = $this->entityManager->getStorage(Text::class);
    $this->textRepository = $storage->getRepository();
  }

  /**
   * Returns all texts.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   */
  public function index(): ViewInterface {
    $textTable = new TextTable($this->textRepository->all());

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
    ]);
  }

  /**
   * Returns the view for creating texts.
   *
   * @return \Src\View\ViewInterface
   *   The view.
   */
  public function create(): ViewInterface {
    $textTable = new TextTable($this->textRepository->all());

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
      'createText' => TRUE,
    ]);
  }

  /**
   * Stores the text in the database.
   *
   * @return \Src\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function store() {
    $create = new CreateTextAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   * Returns an edit view for texts.
   *
   * @return \Components\Header\Redirect|ViewInterface
   *   The view.
   */
  public function edit() {
    $textTable = new TextTable($this->textRepository->all());
    $text = $this->textRepository->loadById((int) $this->request()->getRouteParameter());
    if ($text === NULL) {
      $this->session()->flash(StateInterface::FAILED, Translation::get('text_does_not_exists'));

      return new Redirect('/admin/configuration/texts');
    }

    return $this->view('index', [
      'title' => Translation::get('texts_title'),
      'texts' => $textTable->get(),
      'text' => $text,
    ]);
  }

  /**
   * Updates the text in the database.
   *
   * @return \Src\View\ViewInterface|\Components\Header\Redirect
   *   Returns the view or a redirect response.
   */
  public function update() {
    $update = new UpdateTextAction();
    if ($update->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->edit();
  }

  /**
   * Destroys a text in the database.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  public function destroy(): Redirect {
    $destroy = new DeleteTextAction();
    $destroy->execute();

    return new Redirect($this->redirectBack);
  }

}