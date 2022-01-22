<?php
declare(strict_types=1);

namespace Modules\Cms\Structure;

use Modules\Cms\Structure\Controllers\StructureController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for the structure of the cms.
 *
 * @package Modules\Cms\Structure
 */
#[Module(
  name: 'Cms_Structure',
  routes: [
    StructureController::class,
  ]
)]
class StructureModule extends ModuleBase {

}
