<?php

declare(strict_types=1);

namespace Framework\Http\Router;

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Psr\Http\Message\ServerRequestInterface;

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

    public function match(ServerRequestInterface $request): Result
    {
        /** @var Route $route */
        foreach ($this->routes->getRoutes() as $route) {
            if ($route->getMethods() && !\in_array($request->getMethod(), $route->getMethods(), true)) {
                continue;
            }

            $pattern = \preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use ($route) {
                $argument = $matches[1];
                $replace = $route->getTokens()[$argument] ?? '[^}]+';

                return \sprintf('(?P<%s>%s)', $argument, $replace);
            }, $route->getPattern());

            if (\preg_match(\sprintf('~^%s$~i', $pattern), $request->getUri()->getPath(), $matches)) {
                return new Result(
                    $route->getName(),
                    $route->getHandler(),
                    \array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
                );
            }
        }

        throw new RequestNotMatchedException($request);
    }

    public function generate(string $name, array $params = []): string
    {
        $arguments = \array_filter($params);

        /** @var Route $route */
        foreach ($this->routes->getRoutes() as $route) {
            if ($name !== $route->getName()) {
                continue;
            }

            $url = \preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use (&$arguments) {
                $argument = $matches[1];
                if (!\array_key_exists($argument, $arguments)) {
                    throw new \InvalidArgumentException(\sprintf('Missing argument %s', $argument));
                }

                return $arguments[$argument];
            }, $route->getPattern());

            if (null !== $url) {
                return $url;
            }
        }

        throw new Exception\RouteNotFoundException($name, $params);
    }
}
