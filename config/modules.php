<?php

use Modules\Authentication\AuthenticationModule;
use Modules\Cms\Structure\StructureModule;
use Modules\Contact\ContactModule;
use Modules\Event\EventModule;
use Modules\File\FileModule;
use Modules\Menu\MenuModule;
use Modules\Page\PageModule;
use Modules\Reports\ReportsModule;
use Modules\Setting\SettingModule;
use Modules\Slug\SlugModule;
use Modules\Text\TextModule;
use Modules\User\AccountModule;

return [
  StructureModule::class,
  TextModule::class,
  SettingModule::class,
  ReportsModule::class,
  ContactModule::class,
  FileModule::class,
  SlugModule::class,
  MenuModule::class,
  PageModule::class,
  EventModule::class,
  AccountModule::class,
  AuthenticationModule::class,
];
