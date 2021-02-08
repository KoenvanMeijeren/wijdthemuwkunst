<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\ViewModels;

use Components\ComponentsTrait;
use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Domain\Admin\Pages\Models\Page;
use stdClass;
use System\StateInterface;

/**
 *
 */
final class EditViewModel {

  use ComponentsTrait;

  private ?stdClass $page;

  /**
   *
   */
  public function __construct(?stdClass $page) {
    $this->page = $page;
  }

  /**
   * @return \Src\Core|object
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function get() {
    if ($this->page === NULL) {
      $page = new Page();

      $this->session()->flash(
            StateInterface::FAILED,
            sprintf(
                TranslationOld::get('admin_page_cannot_be_visited'),
                $page->getSlug()
            )
        );

      return new Redirect('/admin/content/pages');
    }

    return $this->page;
  }

}
