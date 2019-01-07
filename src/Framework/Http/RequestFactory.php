<?php

declare(strict_types=1);

namespace Framework\Http;

class RequestFactory
{
    public static function fromGlobals(array $query = null, array $body = null): Request
    {
        return (new Request())
            ->setQueryParams($query ?? $_GET)
            ->setParsedBody($body ?? $_POST)
            ;
    }
}
