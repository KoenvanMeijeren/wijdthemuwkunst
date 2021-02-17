<?php

use Modules\Cms\Structure\StructureModule;
use Modules\Contact\ContactModule;
use Modules\Reports\ReportsModule;
use Modules\Setting\SettingModule;
use Modules\Text\TextModule;

return [
  TextModule::class,
  SettingModule::class,
  ReportsModule::class,
  StructureModule::class,
  ContactModule::class,
];
