<?php
declare(strict_types=1);

namespace App\Router;

class Router {
    private string $url;
    private array $routes = [];

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function get(string $path, callable $callable): Route {
        return $this->add($path, $callable, 'GET');
    }

    public function post(string $path, callable $callable): Route {
        return $this->add($path, $callable, 'POST');
    }

    public function add(string $path, callable $callable, string $method): Route {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function run(): mixed {
        $method = $_SERVER['REQUEST_METHOD'] ?? null;
        if ($method !== null) {
            foreach ($this->routes[$method] as $route) {
                if ($route->match($this->url)) {
                    return $route->call();
                }
            }
        }
        throw new NoRouteMatchesException($this->url, $method, "No route matches this method and url.");
    }
}