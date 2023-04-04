<?php
declare(strict_types=1);

namespace Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class OpenLibrary extends AbstractWrapper {
    private Client $httpClient;

    public function __construct() {
        parent::__construct('https://openlibrary.org');
        $this->httpClient = $this->getHttpClient();
    }

    public function getWorkByOLID(string $olid) {
        return $this->httpClient->getAsync('/works/' . $olid . '.json');
    }

    public function getEditionByOLID(string $olid) {
        return $this->httpClient->getAsync('/books/' . $olid . '.json');
    }

    public function getEditionByISBN(string $isbn) {
        return $this->httpClient->getAsync('/isbn/' . $isbn . '.json');
    }

    public function getAuthorByOLID(string $olid) {
        return $this->httpClient->getAsync('/authors/' . $olid . '.json');
    }

    public function getAuthorsWorks(string $authorsOLID, int $limit = 50) {
        return $this->httpClient->requestAsync('GET', '/authors/' . $authorsOLID . '/works.json', ['query'=>['limit'=>strval($limit)]]);
    }

    public function getWorksBySubject(string $subject) {
        return $this->httpClient->getAsync('/subjects/' . urlencode($subject) . '.json');
    }
}