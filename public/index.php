<?php

declare(strict_types = 1);

use App\App;
use App\Config;
use App\Controllers\FetchController;
use App\Controllers\HomeController;
use App\Controllers\UploadController;
use App\Models\UploadModel;
use App\Router;


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/upload', [UploadController::class, 'upload'])
    ->get('/successful', [UploadModel::class, 'successful'])
    ->post('/retrieveData', [FetchController::class, 'retrieveData'])
    ->get('/transactions', [UploadModel::class, 'transactions']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
