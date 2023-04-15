<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

$app->get('/', \App\Controller\HomeController::class . ':index');

$app->get('/search', \App\Controller\SearchController::class . ':index');

$app->get('/trends', \App\Controller\TrendsController::class . ':index');

$app->get('/recommendations', \App\Controller\RecommendationsController::class . ':index');

$app->get('/team', \App\Controller\TeamController::class . ':index');

$app->get('/book/{isbn:[0-9]{10,13}}', \App\Controller\BookController::class . ':index');

$app->run();