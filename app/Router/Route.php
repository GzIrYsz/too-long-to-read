<?php
declare(strict_types=1);

namespace App\Router;

class Route {
    private string $path;
    private $callable;
    private array $matches = [];
    private array $params = [];

    public function __construct(string $path, callable $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function match(string $url): bool {
        $url = trim($url, '/');
        if (!preg_match('#^' . $this->path . '$#', $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call(): mixed {
        return call_user_func_array($this->callable, $this->matches);
    }
}