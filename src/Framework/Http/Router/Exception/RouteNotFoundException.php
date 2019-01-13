<?php

declare(strict_types=1);

namespace Framework\Http\Router\Exception;

class RouteNotFoundException extends \LogicException
{
    /** @var string */
    private $name;

    /** @var array */
    private $params;

    /**
     * RouteNotFoundException constructor.
     *
     * @param string $name
     * @param array  $params
     */
    public function __construct(string $name, array $params)
    {
        parent::__construct(\sprintf('The route "%s" is not found', $name));

        $this->name = $name;
        $this->params = $params;
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
     * @return RouteNotFoundException
     */
    public function setName(string $name): RouteNotFoundException
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return RouteNotFoundException
     */
    public function setParams(array $params): RouteNotFoundException
    {
        $this->params = $params;
        return $this;
    }
}
