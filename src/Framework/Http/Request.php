<?php

declare(strict_types=1);

namespace Framework\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface
{
    private $queryParams;
    private $parsedBody;

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function withQueryParams(array $queryParams): self
    {
        $new = clone $this;
        $new->queryParams = $queryParams;

        return $new;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function withParsedBody($parsedBody): self
    {
        $new = clone $this;
        $new->parsedBody = $parsedBody;

        return $new;
    }

    public function getProtocolVersion(): void
    {
    }

    public function withProtocolVersion($version): void
    {
    }

    public function getHeaders(): void
    {
    }

    public function hasHeader($name): void
    {
    }

    public function getHeader($name): void
    {
    }

    public function getHeaderLine($name): void
    {
    }

    public function withHeader($name, $value): void
    {
    }

    public function withAddedHeader($name, $value): void
    {
    }

    public function withoutHeader($name): void
    {
    }

    public function getBody(): void
    {
    }

    public function withBody(StreamInterface $body): void
    {
    }

    public function getRequestTarget(): void
    {
    }

    public function withRequestTarget($requestTarget): void
    {
    }

    public function getMethod(): void
    {
    }

    public function withMethod($method): void
    {
    }

    public function getUri(): void
    {
    }

    public function withUri(UriInterface $uri, $preserveHost = false): void
    {
    }

    public function getServerParams(): void
    {
    }

    public function getCookieParams(): void
    {
    }

    public function withCookieParams(array $cookies): void
    {
    }

    public function getUploadedFiles(): void
    {
    }

    public function withUploadedFiles(array $uploadedFiles): void
    {
    }

    public function getAttributes(): void
    {
    }

    public function getAttribute($name, $default = null): void
    {
    }

    public function withAttribute($name, $value): void
    {
    }

    public function withoutAttribute($name): void
    {
    }
}
