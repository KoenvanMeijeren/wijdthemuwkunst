<?php

use Components\Route\Router;
use Modules\Cms\Structure\Controllers\StructureControllerBase;
use Modules\User\Entity\AccountInterface;

Router::prefix('admin')->group(static function() {
  Router::get('dashboard', StructureControllerBase::class,
    'index', AccountInterface::ADMIN);

  Router::get('content', StructureControllerBase::class,
    'content', AccountInterface::ADMIN);

  Router::get('structure', StructureControllerBase::class,
    'structure', AccountInterface::ADMIN);

  Router::get('configuration', StructureControllerBase::class,
    'configuration', AccountInterface::ADMIN);

  Router::get('reports', StructureControllerBase::class,
    'reports', AccountInterface::DEVELOPER);
});
