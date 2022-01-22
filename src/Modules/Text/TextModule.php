<?php
declare(strict_types=1);

namespace Modules\Text;

use Modules\Text\Controllers\TextController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Defines the text module.
 *
 * @package Domain\Admin\Text
 */
#[Module(
  name: 'Text',
  routes: [
    TextController::class,
  ]
)]
class TextModule extends ModuleBase {

}
