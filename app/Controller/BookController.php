<?php

namespace App\Controller;

use App\Model\Book\GoogleApiBookBuilder;
use App\Model\Book\Librarian;
use Core\Controller\AbstractController;
use Dotenv\Dotenv;
use Google\Client;
use Google\Service\Books;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends AbstractController {
    public function index(Request $req, Response $res, array $args): Response {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
        $client = new Client();
        $client->setApplicationName("Too Long To Read");
        $client->setDeveloperKey(getenv('GOOGLEAPI_TOKEN'));
        $service = new Books($client);
        $results = $service->volumes->get($args['isbn']);
        $librarian = new Librarian(new GoogleApiBookBuilder());
        $book = $librarian->makeBook($results);
        setcookie('lastBookId', $book->getGId(), time()+60*60*24*365, '/');
        $this->updateAccessedBooks($book->getGId());
        /******************************/
        $author = 'Thomas REMY';
        $description = 'description';
        $keywords = 'a, b, c';
        $title = $book->getTitle();
        $res->getBody()->write($this->render('book', compact('author', 'description', 'keywords', 'title', 'book')));
        return $res;
    }

    private function updateAccessedBooks(string $id): void {
        $FILE_PATH = "../data/accessedBooks.csv";
        if (!file_exists($FILE_PATH)) {
            $this->createCsvWithHeader(['googleId', 'count']);
        }
        $handle = fopen($FILE_PATH, 'r+');
        $idFound = false;
        $currentLign = fgetcsv($handle);
        while ($currentLign != false && !$idFound) {
            $lineStart = ftell($handle);
            $currentLign = fgetcsv($handle);
            if (!empty($currentLign) && $currentLign[0] == $id) {
                fseek($handle, $lineStart);
                fputcsv($handle, [$currentLign[0], ++$currentLign[1]]);
                $idFound = true;
            }
        }
        if (!$idFound) {
            fputcsv($handle, [$id, 1]);
        }
    }

    private function createCsvWithHeader(array $header) {
        $FILE_PATH = "../data/accessedBooks.csv";
        $handle = fopen($FILE_PATH, 'w');
        fputcsv($handle, $header);
    }
}