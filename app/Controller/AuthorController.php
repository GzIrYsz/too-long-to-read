<?php

namespace App\Controller;

use App\Model\Author\AuthorDirector;
use App\Model\Author\OpenLibraryAuthorBuilder;
use App\Model\Wrapper\OpenLibrary;
use Core\Controller\AbstractController;
use Dotenv\Parser\Parser;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthorController extends AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $client = new OpenLibrary();
        $results = $client->searchForAuthor(urldecode($args['author']))->getBody()->getContents();
        $authorDirector = new AuthorDirector(new OpenLibraryAuthorBuilder());
        $jsonDec = json_decode($results);
        if (empty($jsonDec->docs[0])) {
            $res->getBody()->write("<h1>Not found !</h1>");
            return $res->withStatus(404);
        }
        $foundAuthor = $authorDirector->makeAuthor($jsonDec->docs[0]);
        /******************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = $foundAuthor->getName();
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('author', compact('author', 'description', 'keywords', 'title', 'lastBookId', 'foundAuthor')));
        return $res;
    }
}