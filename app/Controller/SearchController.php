<?php

namespace App\Controller;

use App\Model\Author\AuthorDirector;
use App\Model\Author\OpenLibraryAuthorBuilder;
use App\Model\Wrapper\OpenLibrary;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SearchController extends \Core\Controller\AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        if (!empty($params['q'])) {
            return $this->searchRouter($req, $res, $params);
        }
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = 'Test Page';
        $res->getBody()->write($this->render('search', compact('author', 'description', 'keywords', 'title')));
        return $res;
    }

    private function searchRouter(Request $req, Response $res, array $args): Response {
        return match ($args['mode']) {
            'book' => $this->searchBook($req, $res, $args),
            'author' => $this->searchAuthor($req, $res, $args),
            'theme' => $this->searchTheme($req, $res, $args),
            default => $this->searchAll($req, $res, $args),
        };
    }

    public function searchBook(Request $req, Response $res, array $args): Response {
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
        $title = 'Recherche du livre : ' . $currentSearch;
        $res->getBody()->write($this->render('searchresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }

    public function searchAll(Request $req, Response $res, array $args): Response {
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
        $title = 'Recherche : ' . $currentSearch;
        $res->getBody()->write($this->render('searchallresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }

    public function searchAuthor(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        $currentSearch = $params['q'];
        $authors = [];
        $ol = new OpenLibrary();
        $result = $ol->searchForAuthor($args['q'])->getBody()->getContents();
        $authorDirector = new AuthorDirector(new OpenLibraryAuthorBuilder());
        $decJson = json_decode($result);
        foreach ($decJson->docs as $author) {
            $authors[] = $authorDirector->makeAuthor($author);
        }
        /************************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = "Recherche de l'auteur : " . $currentSearch;
        $res->getBody()->write($this->render('searchauthorresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'authors')));
        return $res;
    }

    public function searchTheme(Request $req, Response $res, array $args): Response {
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
        $res->getBody()->write($this->render('searchthemeresults', compact('author', 'description', 'keywords', 'title', 'currentSearch', 'books')));
        return $res;
    }
}