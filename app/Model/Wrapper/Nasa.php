<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

require 'vendor/autoload.php';

use Core\Wrapper\AbstractWrapper;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

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
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getApod(): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token]]);
    }

    /**
     * Fetches an Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param string $date The date of the picture to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getSpecificApod(string $date): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'date'=>$date]]);
    }

    /**
     * Fetches multiple Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param string $startDate The start date of the range.
     * @param string $endDate The end date of the range.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getRangedApod(string $startDate, string $endDate): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'start_date'=>$startDate, 'end_date'=>$endDate]]);
    }

    /**
     * Fetches multiple Astronomy Picture of the Day from the Nasa API according to a query.
     *
     * @param int $n The number of random pictures to fetch.
     * @return PromiseInterface The promise corresponding to the web request.
     */
    public function getNApod(int $n): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'count'=>strval($n)]]);
    }
}