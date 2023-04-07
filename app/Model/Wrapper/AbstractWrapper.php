<?php
declare(strict_types=1);

namespace App\Model\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Client;

abstract class AbstractWrapper {
    private Client $httpClient;
    private string $baseUri;

    public function __construct(string $baseUri) {
        $this->setBaseUri($baseUri);

        $this->httpClient = new Client(['base_uri'=>$this->baseUri]);
    }

    /**
     * @return string
     */
    public function getBaseUri(): string {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri): void {
        $this->baseUri = $baseUri;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client {
        return $this->httpClient;
    }
}