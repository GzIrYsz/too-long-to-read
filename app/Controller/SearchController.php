<?php

namespace App\Controller;

use App\Model\Author\AuthorDirector;
use App\Model\Author\OpenLibraryAuthorBuilder;
use App\Model\Book\GoogleApiBookBuilder;
use App\Model\Book\Librarian;
use App\Model\Wrapper\OpenLibrary;
use Core\Controller\AbstractController;
use Dotenv\Dotenv;
use Google\Client;
use Google\Service\Books;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SearchController extends AbstractController {
    private int $nbBooksPerPage = 20;

    public function index(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        if (!empty($params['q'])) {
            return $this->searchRouter($req, $res, $params);
        }
        $author = 'Thomas REMY';
        $description = "Cette page propose un système de recherche de livres par titre, catégorie ou auteur.";
        $keywords = 'recherche, livre, auteur, écrivain, catégorie, thème';
        $title = 'Recherche';
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('search', compact('author',
            'description', 'keywords', 'title', 'lastBookId')));
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

    public function searchAll(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        $currentSearch = $params['q'];
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $client = new Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey($_ENV['GOOGLEAPI_TOKEN']);
        $service = new Books($client);
        $ol = new OpenLibrary();
        $results = $service->volumes->listVolumes($currentSearch, ['maxResults' => $this->nbBooksPerPage,
            'startIndex' => $_GET['startIndex'] ?? 0]);
        $librarian = new Librarian(new GoogleApiBookBuilder());
        $books = [];
        $booksAuthors = [];
        $i = 0;
        foreach ($results->getItems() as $result) {
            $books[] = $librarian->makeBook($result);
            if (!array_key_exists(end($books)->getAuthor(1), $booksAuthors)) {
                if ($i > 4) {
                    continue;
                }
                $stdAuthor = json_decode($ol->searchForAuthor(end($books)->getAuthor(1))->getBody()->getContents());
                $authorDirector = new AuthorDirector(new OpenLibraryAuthorBuilder());
                $author = null;
                if (!empty($stdAuthor->docs[0])) {
                    $author = $authorDirector->makeAuthor($stdAuthor->docs[0]);
                    if (!array_key_exists($author->getName(), $booksAuthors)) {
                        $booksAuthors[end($books)->getAuthor(1)] = $author;
                        $i++;
                    }
                }
            }
        }
        $prev = $this->getPrevUrl();
        $next = $this->getNextUrl();
        if (count($results->getItems()) < $this->nbBooksPerPage) {
            $next = null;
        }
        /************************************/
        $author = 'Thomas REMY';
        $description = "Cette page présente les résultats de recherche.";
        $keywords = 'recherche, livre, auteur, écrivain';
        $title = 'Recherche : ' . $currentSearch;
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('searchallresults', compact('author',
            'description', 'keywords', 'title', 'lastBookId', 'currentSearch', 'books', 'booksAuthors', 'prev', 'next')));
        return $res;
    }

    public function searchBook(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        $currentSearch = $params['q'];
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $client = new Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey(getenv('GOOGLEAPI_TOKEN'));
        $service = new Books($client);
        $results = $service->volumes->listVolumes($currentSearch, ['maxResults' => $this->nbBooksPerPage,
            'startIndex' => $_GET['startIndex'] ?? 0]);
        $librarian = new Librarian(new GoogleApiBookBuilder());
        $books = [];
        foreach ($results->getItems() as $result) {
            $books[] = $librarian->makeBook($result);
        }
        $prev = $this->getPrevUrl();
        $next = $this->getNextUrl();
        if (count($results->getItems()) < $this->nbBooksPerPage) {
            $next = null;
        }
        /************************************/
        $author = 'Thomas REMY';
        $description = "Cette page présente les résultats de recherche par rapport à un titre de livre choisi par l'utilisateur.";
        $keywords = 'recherche, livre';
        $title = 'Recherche du livre : ' . $currentSearch;
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('searchbookresults', compact('author',
            'description', 'keywords', 'title', 'lastBookId', 'currentSearch', 'books', 'prev', 'next')));
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
        $description = "Cette page présente les résultats de recherche par rapport à un auteur choisi par l'utilisateur.";
        $keywords = 'recherche, auteur, auteurs, écrivain';
        $title = "Recherche de l'auteur : " . $currentSearch;
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('searchauthorresults', compact('author',
            'description', 'keywords', 'title', 'lastBookId', 'currentSearch', 'authors')));
        return $res;
    }

    public function searchTheme(Request $req, Response $res, array $args): Response {
        $params = $req->getQueryParams();
        $currentSearch = $params['q'];
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $client = new Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey(getenv('GOOGLEAPI_TOKEN'));
        $service = new Books($client);
        $results = $service->volumes->listVolumes("+subject" . $currentSearch, ['maxResults' => $this->nbBooksPerPage,
            'startIndex' => $_GET['startIndex'] ?? 0]);
        $librarian = new Librarian(new GoogleApiBookBuilder());
        $books = [];
        foreach ($results->getItems() as $result) {
            $books[] = $librarian->makeBook($result);
        }
        $prev = $this->getPrevUrl();
        $next = $this->getNextUrl();
        if (count($results->getItems()) < $this->nbBooksPerPage) {
            $next = null;
        }
        /************************************/
        $author = 'Thomas REMY';
        $description = "Cette page présente les résultats de recherche par rapport à un thème choisi par l'utilisateur.";
        $keywords = 'recherche, livres, themes, catégories';
        $title = 'Recherche du thème : ' . $currentSearch;
        $lastBookId = $_COOKIE['lastBookId'] ?? null;
        $res->getBody()->write($this->render('searchthemeresults', compact('author',
            'description', 'keywords', 'title', 'lastBookId', 'currentSearch', 'books', 'prev', 'next')));
        return $res;
    }

    private function getPrevUrl(): string|null {
        $url = null;
        if (isset($_GET['startIndex']) && $_GET['startIndex'] != 0) {
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $url .= "?";
            $queryString = $_SERVER['QUERY_STRING'];
            parse_str($queryString, $queryParams);
            $queryParams['startIndex'] -= $this->nbBooksPerPage;
            $url .= http_build_query($queryParams);
        }
        return $url;
    }

    private function getNextUrl(bool $max = false): string|null {
        $url = null;
        if (!$max) {
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $url .= "?";
            $queryString = $_SERVER['QUERY_STRING'];
            parse_str($queryString, $queryParams);
            $queryParams['startIndex'] += $this->nbBooksPerPage;
            $url .= http_build_query($queryParams);
        }
        return $url;
    }
}