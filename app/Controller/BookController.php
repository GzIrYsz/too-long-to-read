<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad();
        $client = new \Google\Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey(getenv('GOOGLEAPI_TOKEN'));
        $service = new \Google\Service\Books($client);
        $results = $service->volumes->get($args['isbn']);
        $librarian = new \App\Model\Book\Librarian(new \App\Model\Book\GoogleApiBookBuilder());
        $book = $librarian->makeBook($results);
        /******************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = $book->getTitle();
        $res->getBody()->write($this->render('book', compact('author', 'description', 'keywords', 'title', 'book')));
        return $res;
    }
}