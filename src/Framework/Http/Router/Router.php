<?php

declare(strict_types=1);

namespace Framework\Http\Router;

use Psr\Http\Message\RequestInterface;

class Router
{
    /** @var RouteCollection */
    private $routes;

    /**
     * Router constructor.
     *
     * @param RouteCollection $routes
     */
    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(RequestInterface $request): Result
    {
        return new Result();
    }

    public function generate(string $name, array $params = []): string
    {
        return '';
    }
}
