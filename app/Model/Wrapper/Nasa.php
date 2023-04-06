<?php
declare(strict_types=1);

namespace Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Client;

class Nasa extends AbstractWrapper {
    private Client $httpClient;
    private string $token;

    public function __construct(string $token) {
        parent::__construct('https://api.nasa.gov');
        $this->httpClient = $this->getHttpClient();
        $this->token = $token;
    }

    public function getApod(string $date = null, string $startDate = null, string $endDate = null): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token]]);
    }
}