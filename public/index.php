<?php
declare(strict_types=1);

use App\Controller\AuthorController;
use App\Controller\BookController;
use App\Controller\HomeController;
use App\Controller\StatsController;
use App\Controller\SearchController;
use App\Controller\TeamController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

$app->get('/', HomeController::class . ':index');

$app->get('/search', SearchController::class . ':index');

$app->get('/stats', StatsController::class . ':index');

$app->get('/team', TeamController::class . ':index');

$app->get('/book/{isbn}', BookController::class . ':index');

$app->get('/author/{author}', AuthorController::class . ':index');

$app->run();