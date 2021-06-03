<?php
declare(strict_types=1);

namespace Modules\Page\Controllers;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Modules\Page\Actions\CreatePageAction;
use Modules\Page\Actions\DeletePageAction;
use Modules\Page\Actions\PublishPageAction;
use Modules\Page\Actions\RemovePageBannerAction;
use Modules\Page\Actions\RemovePageThumbnailAction;
use Modules\Page\Actions\SaveAndPublishPageAction;
use Modules\Page\Actions\UnPublishPageAction;
use Modules\Page\Actions\UpdatePageAction;
use Components\View\ViewInterface;
use Modules\Page\Entity\Page;
use Modules\Page\Entity\PageInterface;
use Modules\Page\Entity\PageTable;
use System\Entity\EntityControllerBase;
use System\StateInterface;

/**
 * Provides a class for page actions.
 *
 * @package Domain\Admin\Page\Controllers
 */
final class AdminPageController extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/content/pages';

  /**
   * The path to redirect if we do not want to go back.
   *
   * @var string
   */
  protected string $redirectSame = '/admin/content/pages/page/edit/';

  /**
   * AdminPageController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Page::class, baseViewPath: 'Page/Views/admin.');
  }

  public function index(): ViewInterface {
    $pageTable = new PageTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('admin_page_title'),
      'pages' => $pageTable->get(),
    ]);
  }

  public function create(): ViewInterface {
    return $this->view('edit', [
      'title' => TranslationOld::get('admin_create_page_title'),
    ]);
  }

  public function store(): ViewInterface|Redirect {
    $create = new CreatePageAction();
    if ($this->request()->post('save-and-publish') !== '') {
      $create = new SaveAndPublishPageAction();
    }

    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  public function edit(): ViewInterface|Redirect {
    $page = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if (!$page instanceof PageInterface) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('page_does_not_exists'));

      return new Redirect($this->redirectBack);
    }

    return $this->view('edit', [
      'title' => sprintf(TranslationOld::get('admin_edit_page_title'), $page->getTitle()),
      'page' => $page,
    ]);
  }

  public function update(): ViewInterface|Redirect {
    $update = new UpdatePageAction();
    if (array_key_exists('save-and-publish', $_POST)) {
      $update = new SaveAndPublishPageAction();
    }

    if ($update->execute()) {
      return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
    }

    return $this->edit();
  }

  public function publish(): Redirect {
    $publish = new PublishPageAction();
    $publish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function unPublish(): Redirect {
    $unPublish = new UnPublishPageAction();
    $unPublish->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function removeThumbnail(): Redirect {
    $removeThumbnail = new RemovePageThumbnailAction();
    $removeThumbnail->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function removeBanner(): Redirect {
    $removeBanner = new RemovePageBannerAction();
    $removeBanner->execute();

    return new Redirect($this->redirectSame . $this->request()->getRouteParameter());
  }

  public function destroy(): Redirect {
    $delete = new DeletePageAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
