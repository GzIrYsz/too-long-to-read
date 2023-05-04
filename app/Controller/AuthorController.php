<?php

namespace App\Controller;

use App\Model\Author\AuthorDirector;
use App\Model\Author\OpenLibraryAuthorBuilder;
use App\Model\Wrapper\OpenLibrary;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthorController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $client = new OpenLibrary();
        $results = null;
        $client->searchForAuthor($args['author'])
            ->then(function (Response $response) use (&$results) {
                $results = $response->getBody()->getContents();
            },
            function (RequestException $e) {})
            ->wait();
        $authorDirector = new AuthorDirector(new OpenLibraryAuthorBuilder());
        $jsonDec = json_decode($results);
        $foundAuthor = $authorDirector->makeAuthor($jsonDec->docs[0]);
        /******************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = $foundAuthor->getName();
        $res->getBody()->write($this->render('author', compact('author', 'description', 'keywords', 'title', 'foundAuthor')));
        return $res;
    }
}