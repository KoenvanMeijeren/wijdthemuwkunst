<?php

namespace Modules\Contact\Controller;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\Contact\Actions\DeleteContactMessageAction;
use Modules\Contact\Entity\Contact;
use Modules\Contact\Entity\ContactRepositoryInterface;
use System\Entity\EntityControllerBase;
use System\Entity\EntityRepositoryInterface;

/**
 * The contact form controller.
 *
 * @package Modules\Contact\Controller
 */
final class AdminContactController extends EntityControllerBase {

  /**
   * The entity repository definition.
   *
   * @var ContactRepositoryInterface
   */
  protected readonly EntityRepositoryInterface $repository;

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected readonly string $redirectBack;

  /**
   * AdminContactController constructor.
   *
   * {@inheritDoc}
   */
  public function __construct(){
    parent::__construct(entityClass: Contact::class, baseViewPath: 'Contact/Views/');

    $this->redirectBack = '/admin/content/contact';
  }

  /**
   * Displays all contact requests.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet(url: 'admin/content/contact', rights: RouteRights::ADMIN)]
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_contact_form_title'),
      'messages' => $this->repository->all(),
    ]);
  }

  /**
   * Displays all contact request for a given date.
   *
   * @return \Components\View\ViewInterface
   *   The view.
   */
  #[RouteGet(url: 'admin/content/contact/filter', rights: RouteRights::ADMIN)]
  public function showByDate(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_contact_form_title'),
      'messages' => $this->repository->loadByDate($this->request()->get('date')),
    ]);
  }

  /**
   * Destroys one contact request.
   *
   * @return Redirect
   *   The redirect response.
   */
  #[RoutePost(url: 'admin/content/contact/delete/{slug}', rights: RouteRights::ADMIN)]
  public function destroy(): Redirect {
    $delete = new DeleteContactMessageAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
