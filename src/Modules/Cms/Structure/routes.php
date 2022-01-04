<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Cms\Structure\Controllers\StructureControllerBase;

Router::prefix('admin')->group(static function() {
  Router::get('dashboard', StructureControllerBase::class,
    'index', RouteRights::ADMIN);

  Router::get('content', StructureControllerBase::class,
    'content', RouteRights::ADMIN);

  Router::get('structure', StructureControllerBase::class,
    'structure', RouteRights::ADMIN);

  Router::get('configuration', StructureControllerBase::class,
    'configuration', RouteRights::ADMIN);

  Router::get('reports', StructureControllerBase::class,
    'reports', RouteRights::DEVELOPER);
});
