<?php
declare(strict_types=1);

namespace Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;

class OpenLibrary extends AbstractWrapper {
    public function __construct() {
        parent::__construct('https://openlibrary.org');
    }

    public function getWorkByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/works/' . $olid . '.json');
    }

    public function getEditionByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/books/' . $olid . '.json');
    }

    public function getEditionByISBN(string $isbn): PromiseInterface {
        return $this->getHttpClient()->getAsync('/isbn/' . $isbn . '.json');
    }

    public function getAuthorByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/authors/' . $olid . '.json');
    }

    public function getAuthorsWorks(string $authorsOLID, int $limit = 50): PromiseInterface {
        return $this->getHttpClient()->requestAsync('GET', '/authors/' . $authorsOLID . '/works.json', ['query'=>['limit'=>strval($limit)]]);
    }

    public function getWorksBySubject(string $subject): PromiseInterface {
        return $this->getHttpClient()->getAsync('/subjects/' . urlencode($subject) . '.json');
    }

    public function search(string $q): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['q'=>urlencode($q)]]);
    }

    public function searchByTitle(string $title): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['title'=>urlencode($title)]]);
    }

    public function searchByAuthor(string $author): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['author'=>urlencode($author)]]);
    }

    public function searchForAuthor(string $q): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search/authors.json', ['query'=>['q'=>urlencode($q)]]);
    }
}