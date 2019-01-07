<?php

declare(strict_types=1);

namespace App\Tests\Framework\Http;

use Framework\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testEmptyResponse(): void
    {
        $response = new Response($body = 'body');

        self::assertEquals($body, $response->getBody());
        self::assertEquals(200, $response->getStatusCode());
    }

    public function test404Response(): void
    {
        $response = new Response($body = 'empty', $status = 404);

        self::assertEquals($body, $response->getBody());
        self::assertEquals($status, $response->getStatusCode());
        self::assertEquals('Not found', $response->getReasonPhrase());
    }

    public function testHeaders(): void
    {
        $response = (new Response())
            ->withHeader($name1 = 'X-Header-1', $value1 = 'value_1')
            ->withHeader($name2 = 'X-Header-2', $value2 = 'value_2')
        ;

        self::assertEquals([
            $name1 => $value1,
            $name2 => $value2,
        ], $response->getHeaders());
    }
}
