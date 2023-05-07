<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

use Core\Wrapper\AbstractWrapper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * This class wraps the OpenLibrary web API.
 *
 * @author Thomas REMY <contact.t.remy777@gmail.com>
 */
class OpenLibrary extends AbstractWrapper {
    private Client $coversHttpClient;

    /**
     * @var string COVER_SIZE_SMALL The parameter needed when getting a small size cover.
     */
    public const COVER_SIZE_SMALL = 'S';

    /**
     * @var string COVER_SIZE_MEDIUM The parameter needed when getting a medium size cover.
     */
    public const COVER_SIZE_MEDIUM = 'M';

    /**
     * @var string COVER_SIZE_LARGE The parameter needed when getting a large size cover.
     */
    public const COVER_SIZE_LARGE = 'L';

    /**
     * The default constructor.
     */
    public function __construct() {
        parent::__construct('https://openlibrary.org');
        $this->coversHttpClient = new Client(['base_uri'=>'https://covers.openlibrary.org']);
    }

    /**
     * Fetches works from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the work to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getWorkByOLID(string $olid): ResponseInterface {
        return $this->getHttpClient()->get('/works/' . $olid . '.json');
    }

    /**
     * Fetches a specific edition from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the edition to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getEditionByOLID(string $olid): ResponseInterface {
        return $this->getHttpClient()->get('/books/' . $olid . '.json');
    }

    /**
     * Fetches a specific edition from the OpenLibrary catalog according to a query.
     *
     * @param string $isbn The ISBN-10 or ISBN-13 of the edition to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getEditionByISBN(string $isbn): ResponseInterface {
        return $this->getHttpClient()->get('/isbn/' . $isbn . '.json');
    }

    /**
     * Fetches a specific author from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the author to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getAuthorByOLID(string $olid): ResponseInterface {
        return $this->getHttpClient()->get('/authors/' . $olid . '.json');
    }

    /**
     * Fetches works from the OpenLibrary catalog according to a query.
     *
     * @param string $authorsOLID The OpenLibrary ID of the work's author to fetch.
     * @param int $limit The limit number of works to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getAuthorsWorks(string $authorsOLID, int $limit = 50): ResponseInterface {
        return $this->getHttpClient()->get('/authors/' . $authorsOLID . '/works.json', ['query'=>['limit'=>(string) $limit]]);
    }

    /**
     * Fetches works from the OpenLibrary catalog according to a query.
     *
     * @param string $subject The work's subject to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getWorksBySubject(string $subject): ResponseInterface {
        return $this->getHttpClient()->get('/subjects/' . urlencode($subject) . '.json');
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $q The elements to search for.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function search(string $q): ResponseInterface {
        return $this->getHttpClient()->get('/search.json', ['query'=>['q'=>urlencode($q)]]);
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $title The title of the work to search for.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function searchByTitle(string $title): ResponseInterface {
        return $this->getHttpClient()->get('/search.json', ['query'=>['title'=>urlencode($title)]]);
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $author The work's author to search for.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function searchByAuthor(string $author): ResponseInterface {
        return $this->getHttpClient()->get('/search.json', ['query'=>['author'=>urlencode($author)]]);
    }

    /**
     * Fetches authors from the OpenLibrary catalog according to a query.
     *
     * @param string $q The author to search for.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function searchForAuthor(string $q): ResponseInterface {
        return $this->getHttpClient()->get('/search/authors.json', ['query'=>['q'=>urlencode($q), 'sort'=>'work_count desc', 'limit'=>'1']]);
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $id The Cover ID of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getBookCoverByID(string $id, string $size = OpenLibrary::COVER_SIZE_MEDIUM): ResponseInterface {
        return $this->coversHttpClient->get('/b/id/' . $id . '-' . $size . '.jpg');
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getBookCoverByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): ResponseInterface {
        return $this->coversHttpClient->get('/b/olid/' . $olid . '-' . $size . '.jpg');
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $isbn The ISBN-10 or ISBN-13 of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getBookCoverByISBN(string $isbn, string $size = OpenLibrary::COVER_SIZE_MEDIUM): ResponseInterface {
        return $this->coversHttpClient->get('/b/olid/' . $isbn . '-' . $size . '.jpg');
    }

    /**
     * Fetches author's picture from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the author's picture to fetch.
     * @param string $size The size of the author's picture to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getAuthorPictureByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): ResponseInterface {
        return $this->coversHttpClient->get('/a/olid/' . $olid . '-' . $size . '.jpg');
    }
}