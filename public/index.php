<?php
declare(strict_types=1);

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$container = $app->getContainer();

$app->addErrorMiddleware(true, false, false);

$app->get('/', function (Request $req, Response $res, array $args) {
    echo 'home';
    return $res;
});

$app->run();