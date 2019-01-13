<?php

declare(strict_types=1);

namespace Framework\Http\Router;

class Result
{
    /** @var string */
    private $name;
    private $handler;

    /** @var array */
    private $attributes;

    /**
     * Result constructor.
     *
     * @param $name
     * @param $handler
     * @param array $attributes
     */
    public function __construct(string $name, $handler, array $attributes)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Result
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     *
     * @return Result
     */
    public function setHandler($handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return Result
     */
    public function setAttributes(array $attributes): Result
    {
        $this->attributes = $attributes;

        return $this;
    }
}
