<?php

declare(strict_types=1);

namespace Framework\Http\Router;

class Route
{
    /** @var string */
    private $name;

    /** @var string */
    private $pattern;

    /** @var string|callable */
    private $handler;

    /** @var array */
    private $methods;

    /** @var array */
    private $tokens;

    /**
     * Route constructor.
     *
     * @param string          $name
     * @param string          $pattern
     * @param string|callable $handler
     * @param array           $methods
     * @param array|null      $tokens
     */
    public function __construct(string $name, string $pattern, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Route
     */
    public function setName(string $name): Route
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     *
     * @return Route
     */
    public function setPattern(string $pattern): Route
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @return callable|string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param callable|string $handler
     *
     * @return Route
     */
    public function setHandler($handler): Route
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     *
     * @return Route
     */
    public function setMethods(array $methods): Route
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * @param array $tokens
     *
     * @return Route
     */
    public function setTokens(array $tokens): Route
    {
        $this->tokens = $tokens;

        return $this;
    }
}
