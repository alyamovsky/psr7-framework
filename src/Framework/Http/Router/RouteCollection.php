<?php

declare(strict_types=1);

namespace Framework\Http\Router;

class RouteCollection
{
    /** @var Route[] */
    private $routes = [];

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function any(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->routes[] = new Route($name, $pattern, $handler, [], $tokens);
    }

    public function get(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['GET'], $tokens);
    }

    public function post(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['POST'], $tokens);
    }
}
