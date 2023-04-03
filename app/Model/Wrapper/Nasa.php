<?php
declare(strict_types=1);

namespace Model\Wrapper;

require 'AbstractWrapper.php';
require '../../../vendor/autoload.php';

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class Nasa extends AbstractWrapper {
    private string $token;

    public function __construct(string $token) {
        parent::__construct('https://api.nasa.gov');
        $this->token = $token;
    }

//    public function getApod(string $date = null, string $startDate = null, string $endDate = null): PromiseInterface {
//        $client = $this->getHttpClient();
//        return $client->requestAsync('GET', '/planetary/apod', ['query'=>['token'=>$this->token]]);
//    }
    public function getApod(string $date = null, string $startDate = null, string $endDate = null): ResponseInterface {
        $client = $this->getHttpClient();
        $request = new Request('GET', '/planetary/apod', ['query'=>['api_key'=>$this->token]]);
        print_r($request->getHeaders());
        return $client->send($request);
    }
}