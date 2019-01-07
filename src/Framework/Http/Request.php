<?php

declare(strict_types=1);

namespace Framework\Http;

class Request
{
    private $queryParams;
    private $parsedBody;

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function setQueryParams($queryParams): self
    {
        $new = clone $this;
        $new->queryParams = $queryParams;

        return $new;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function setParsedBody($parsedBody): self
    {
        $new = clone $this;
        $new->parsedBody = $parsedBody;

        return $new;
    }
}
