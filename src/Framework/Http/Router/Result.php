<?php

declare(strict_types=1);

namespace Framework\Http\Router;

class Result
{
    private $name;
    private $handler;

    /** @var array */
    private $attributes;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Result
     */
    public function setName($name)
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
    public function setHandler($handler)
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
     * @return Result
     */
    public function setAttributes(array $attributes): Result
    {
        $this->attributes = $attributes;
        return $this;
    }
}
