<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

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

    public function getApod(): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token]]);
    }

    public function getSpecificApod(string $date): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'date'=>$date]]);
    }

    public function getRangedApod(string $startDate, string $endDate): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'start_date'=>$startDate, 'end_date'=>$endDate]]);
    }

    public function getNApod(int $n): PromiseInterface {
        return $this->httpClient->getAsync('/planetary/apod', ['query'=>['api_key'=>$this->token, 'count'=>strval($n)]]);
    }
}