<?php
declare(strict_types=1);

namespace Model\Wrapper;

require 'vendor/autoload.php';

use Google\Service\PeopleService\Resource\People;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class OpenLibrary extends AbstractWrapper {
    private Client $httpClient;

    public function __construct() {
        parent::__construct('https://openlibrary.org');
        $this->httpClient = $this->getHttpClient();
    }

    public function getWorkByOLID(string $olid): PromiseInterface {
        return $this->httpClient->getAsync('/works/' . $olid . '.json');
    }

    public function getEditionByOLID(string $olid): PromiseInterface {
        return $this->httpClient->getAsync('/books/' . $olid . '.json');
    }

    public function getEditionByISBN(string $isbn): PromiseInterface {
        return $this->httpClient->getAsync('/isbn/' . $isbn . '.json');
    }

    public function getAuthorByOLID(string $olid): PromiseInterface {
        return $this->httpClient->getAsync('/authors/' . $olid . '.json');
    }

    public function getAuthorsWorks(string $authorsOLID, int $limit = 50): PromiseInterface {
        return $this->httpClient->requestAsync('GET', '/authors/' . $authorsOLID . '/works.json', ['query'=>['limit'=>strval($limit)]]);
    }

    public function getWorksBySubject(string $subject): PromiseInterface {
        return $this->httpClient->getAsync('/subjects/' . urlencode($subject) . '.json');
    }
}