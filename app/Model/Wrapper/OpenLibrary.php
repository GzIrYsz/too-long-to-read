<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class OpenLibrary extends AbstractWrapper {
    private Client $coversHttpClient;
    public const COVER_SIZE_SMALL = 'S';
    public const COVER_SIZE_MEDIUM = 'M';
    public const COVER_SIZE_LARGE = 'L';

    public function __construct() {
        parent::__construct('https://openlibrary.org');
        $this->coversHttpClient = new Client(['base_uri'=>'https://covers.openlibrary.org']);
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

    public function getBookCoverByID(string $id, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/id/' . $id . '-' . $size . '.jpg');
    }

    public function getBookCoverByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/olid/' . $olid . '-' . $size . '.jpg');
    }

    public function getBookCoverByISBN(string $isbn, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/olid/' . $isbn . '-' . $size . '.jpg');
    }

    public function getAuthorCoverByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/a/olid/' . $olid . '-' . $size . '.jpg');
    }
}