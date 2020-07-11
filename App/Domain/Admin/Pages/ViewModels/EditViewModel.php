<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\ViewModels;

use Domain\Admin\Pages\Models\Page;
use Src\Core\Redirect;
use Src\Core\StateInterface;
use Src\Session\Session;
use Src\Translation\Translation;
use stdClass;

/**
 *
 */
final class EditViewModel {
  private ?stdClass $page;
  private Session $session;

  /**
   *
   */
  public function __construct(?stdClass $page) {
    $this->page = $page;
    $this->session = new Session();
  }

  /**
   * @return \Src\Core|object
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->page === NULL) {
      $page = new Page();

      $this->session->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('admin_page_cannot_be_visited'),
                $page->getSlug()
            )
        );

      return new Redirect('/admin/content/pages');
    }

    return $this->page;
  }

}
