<?php
declare(strict_types=1);

use App\Src\Core\App;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::createImmutable(START_PATH);
$dotEnv->load();

$app = new App();
$app->run();
