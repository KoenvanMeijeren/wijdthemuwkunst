<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use System\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::createImmutable(START_PATH, '.env.development');
$dotEnv->load();

$application = new Application();
$application->run();
