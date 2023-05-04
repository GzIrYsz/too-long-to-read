<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

use Core\Wrapper\AbstractWrapper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * This class wraps the Nasa web API.
 *
 * @author Thomas REMY <contact.t.remy777@gmail.com>
 */
class Nasa extends AbstractWrapper {
    private Client $httpClient;
    private string $token;

    /**
     * The default constructor.
     *
     * @param string $token THe private token used by the API.
     */
    public function __construct(string $token) {
        parent::__construct('https://api.nasa.gov');
        $this->httpClient = $this->getHttpClient();
        $this->token = $token;
    }

    /**
     * Fetches the Astronomy Picture of the Day from the Nasa API.
     *
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getApod(): ResponseInterface {
        return $this->httpClient->get('/planetary/apod', ['query'=>['api_key'=>$this->token]]);
    }

    /**
     * Fetches an Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param string $date The date of the picture to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getSpecificApod(string $date): ResponseInterface {
        return $this->httpClient->get('/planetary/apod', ['query'=>['api_key'=>$this->token, 'date'=>$date]]);
    }

    /**
     * Fetches multiple Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param string $startDate The start date of the range.
     * @param string $endDate The end date of the range.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getRangedApod(string $startDate, string $endDate): ResponseInterface {
        return $this->httpClient->get('/planetary/apod', ['query'=>['api_key'=>$this->token, 'start_date'=>$startDate, 'end_date'=>$endDate]]);
    }

    /**
     * Fetches multiple Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param int $n The number of random pictures to fetch.
     * @return ResponseInterface The promise corresponding to the web request.
     * @throws GuzzleException If something bad happen during the request.
     */
    public function getNApod(int $n): ResponseInterface {
        return $this->httpClient->get('/planetary/apod', ['query'=>['api_key'=>$this->token, 'count'=>(string) $n]]);
    }
}