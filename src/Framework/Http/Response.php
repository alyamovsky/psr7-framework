<?php

declare(strict_types=1);

namespace Framework\Http;

class Response
{
    private $body;
    private $statusCode;
    private $reasonPhrase;
    private $headers;

    private static $phrases = [
        200 => 'OK',
        301 => 'Moved permanently',
        400 => 'Bad request',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
    ];

    public function __construct(string $body = null, int $statusCode = null)
    {
        $this->body = $body;
        $this->statusCode = $statusCode ?? 200;
        $this->reasonPhrase = '';
        $this->headers = [];
    }

    /**
     * @return string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return Response
     */
    public function withBody(string $body): self
    {
        $new = clone $this;
        $new->body = $body;

        return $new;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return Response
     */
    public function withStatusCode(int $statusCode): self
    {
        $new = clone $this;
        $new->statusCode = $statusCode;

        return $new;
    }

    /**
     * @return string
     */
    public function getReasonPhrase(): ?string
    {
        if (!$this->reasonPhrase && isset(self::$phrases[$this->getStatusCode()])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }

        return $this->reasonPhrase;
    }

    /**
     * @param string $reasonPhrase
     *
     * @return Response
     */
    public function setReasonPhrase(string $reasonPhrase): self
    {
        $this->reasonPhrase = $reasonPhrase;

        return $this;
    }

    public function withHeader(string $header, string $value): self
    {
        $new = clone $this;
        $new->headers[$header] = $value;

        return $new;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $header): ?string
    {
        return $this->headers[$header] ?? null;
    }

    public function hasHeader(string $header): bool
    {
        return isset($this->headers[$header]);
    }
}
