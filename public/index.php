<?php
declare(strict_types=1);

use App\Controller\AuthorController;
use App\Controller\BookController;
use App\Controller\HomeController;
use App\Controller\StatsController;
use App\Controller\SearchController;
use App\Controller\TechController;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$counter = function (Request $req, RequestHandler $handler) {
    $res = $handler->handle($req);
    $content = (string) $res->getBody();
    $res = new Response();
    $res->getBody()->write($content);

    $fileName = "../data/hit-counter.txt";
    $count = file_get_contents($fileName);
    $count = intval($count) + 1;
    file_put_contents($fileName, $count);

    return $res;
};

$app->add($counter);

$app->addErrorMiddleware(true, false, false);

$app->get('/', HomeController::class . ':index');

$app->get('/search', SearchController::class . ':index');

$app->get('/stats', StatsController::class . ':index');

//$app->get('/team', TeamController::class . ':index');

$app->get('/book/{isbn}', BookController::class . ':index');

$app->get('/author/{author}', AuthorController::class . ':index');

$app->get('/tech', TechController::class . ':index');

$app->run();