<?php
declare(strict_types=1);

namespace Core\Wrapper;

require 'vendor/autoload.php';

use GuzzleHttp\Client;

/**
 * Provides the basis for a web API wrapper.
 *
 * @author Thomas REMY <contact.t.remy777@gmail.com>
 */
abstract class AbstractWrapper {
    private Client $httpClient;
    private string $baseUri;

    /**
     * The default constructor.
     *
     * @param string $baseUri The base uri used for the requests.
     */
    public function __construct(string $baseUri) {
        $this->setBaseUri($baseUri);

        $this->httpClient = new Client(['base_uri'=>$this->baseUri]);
    }

    /**
     * @return string The base uri used for the requests.
     */
    public function getBaseUri(): string {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri The base uri used for the requests.
     */
    public function setBaseUri(string $baseUri): void {
        $this->baseUri = $baseUri;
    }

    /**
     * @return Client The HTTP client used for the requests.
     */
    public function getHttpClient(): Client {
        return $this->httpClient;
    }
}