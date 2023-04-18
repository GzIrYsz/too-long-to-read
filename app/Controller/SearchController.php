<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SearchController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        if (!empty($params['q'])) {
            return $this->search($req, $res, $params);
        }
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = 'Test Page';
        $res->getBody()->write($this->render('search', compact('author', 'description', 'keywords', 'title')));
        return $res;
    }

    public function search(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        $currentSearch = $params['q'];
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $client = new \Google\Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey(getenv('GOOGLEAPI_TOKEN'));
        $service = new \Google\Service\Books($client);
        $results = $service->volumes->listVolumes($currentSearch);
        $librarian = new \App\Model\Book\Librarian(new \App\Model\Book\GoogleApiBookBuilder());
        $books = [];
        foreach ($results->getItems() as $result) {
            $books[] = $librarian->makeBook($result);
        }
        /************************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = 'Test Page';
        $res->getBody()->write($this->render('searchresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }

    public function searchAll() {

    }

    public function searchAuthor(Request $req, Response $res, array $args): Response {
        $res->getBody()->write($this->render('searchresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }

    public function searchTheme(Request $req, Response $res, array $args): Response {
        $res->getBody()->write($this->render('searchresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }
}