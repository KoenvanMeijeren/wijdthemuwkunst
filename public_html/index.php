<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Src\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::createImmutable(START_PATH, '.env.development');
$dotEnv->load();

$app = new App();
$app->run();
