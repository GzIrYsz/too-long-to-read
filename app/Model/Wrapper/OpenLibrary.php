<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

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
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getWorkByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/works/' . $olid . '.json');
    }

    /**
     * Fetches a specific edition from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the edition to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getEditionByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/books/' . $olid . '.json');
    }

    /**
     * Fetches a specific edition from the OpenLibrary catalog according to a query.
     *
     * @param string $isbn The ISBN-10 or ISBN-13 of the edition to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getEditionByISBN(string $isbn): PromiseInterface {
        return $this->getHttpClient()->getAsync('/isbn/' . $isbn . '.json');
    }

    /**
     * Fetches a specific author from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the author to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getAuthorByOLID(string $olid): PromiseInterface {
        return $this->getHttpClient()->getAsync('/authors/' . $olid . '.json');
    }

    /**
     * Fetches works from the OpenLibrary catalog according to a query.
     *
     * @param string $authorsOLID The OpenLibrary ID of the work's author to fetch.
     * @param int $limit The limit number of works to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getAuthorsWorks(string $authorsOLID, int $limit = 50): PromiseInterface {
        return $this->getHttpClient()->requestAsync('GET', '/authors/' . $authorsOLID . '/works.json', ['query'=>['limit'=>strval($limit)]]);
    }

    /**
     * Fetches works from the OpenLibrary catalog according to a query.
     *
     * @param string $subject The work's subject to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getWorksBySubject(string $subject): PromiseInterface {
        return $this->getHttpClient()->getAsync('/subjects/' . urlencode($subject) . '.json');
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $q The elements to search for.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function search(string $q): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['q'=>urlencode($q)]]);
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $title The title of the work to search for.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function searchByTitle(string $title): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['title'=>urlencode($title)]]);
    }

    /**
     * Fetches editions from the OpenLibrary catalog according to a query.
     *
     * @param string $author The work's author to search for.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function searchByAuthor(string $author): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search.json', ['query'=>['author'=>urlencode($author)]]);
    }

    /**
     * Fetches authors from the OpenLibrary catalog according to a query.
     *
     * @param string $q The author to search for.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function searchForAuthor(string $q): PromiseInterface {
        return $this->getHttpClient()->getAsync('/search/authors.json', ['query'=>['q'=>urlencode($q)]]);
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $id The Cover ID of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getBookCoverByID(string $id, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/id/' . $id . '-' . $size . '.jpg');
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getBookCoverByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/olid/' . $olid . '-' . $size . '.jpg');
    }

    /**
     * Fetches book covers from the OpenLibrary catalog according to a query.
     *
     * @param string $isbn The ISBN-10 or ISBN-13 of the cover to fetch.
     * @param string $size The size of the cover to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getBookCoverByISBN(string $isbn, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/b/olid/' . $isbn . '-' . $size . '.jpg');
    }

    /**
     * Fetches author's picture from the OpenLibrary catalog according to a query.
     *
     * @param string $olid The OpenLibrary ID of the author's picture to fetch.
     * @param string $size The size of the author's picture to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getAuthorPictureByOLID(string $olid, string $size = OpenLibrary::COVER_SIZE_MEDIUM): PromiseInterface {
        return $this->coversHttpClient->getAsync('/a/olid/' . $olid . '-' . $size . '.jpg');
    }
}