<?php
declare(strict_types=1);

namespace Modules\File;

use Modules\File\Controllers\UploadFileController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for files.
 *
 * @package Modules\Reports
 */
#[Module(
  name: 'File',
  routes: [
    UploadFileController::class,
  ]
)]
class FileModule extends ModuleBase {

}
