<?php
declare(strict_types=1);

namespace App\Router;

use Throwable;

class NoRouteMatchesException extends \Exception {
    private string $url;
    private string $method;

    public function __construct(string $url, string $method, string $message = "", ?Throwable $previous = null) {
        parent::__construct($message, 0, $previous);
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}