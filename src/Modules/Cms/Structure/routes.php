<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Cms\Structure\Controllers\StructureControllerBase;

Router::prefix('admin')->group(static function() {
  Router::get('dashboard', StructureControllerBase::class,
    'index', User::ADMIN);

  Router::get('content', StructureControllerBase::class,
    'content', User::ADMIN);

  Router::get('structure', StructureControllerBase::class,
    'structure', User::ADMIN);

  Router::get('configuration', StructureControllerBase::class,
    'configuration', User::ADMIN);

  Router::get('reports', StructureControllerBase::class,
    'reports', User::DEVELOPER);
});
