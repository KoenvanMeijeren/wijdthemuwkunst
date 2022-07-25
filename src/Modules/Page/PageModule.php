<?php
declare(strict_types=1);

namespace Modules\Page;

use Modules\Page\Controllers\AdminPageController;
use Modules\Page\Controllers\PageController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for pages.
 *
 * @package Modules\Page
 */
#[Module(
  name: 'Page',
  routes: [
    PageController::class,
    AdminPageController::class,
  ]
)]
final class PageModule extends ModuleBase {

}
