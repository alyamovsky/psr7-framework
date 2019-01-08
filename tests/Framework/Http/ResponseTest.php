<?php

declare(strict_types=1);

namespace App\Tests\Framework\Http;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response\HtmlResponse;

class ResponseTest extends TestCase
{
    public function testEmptyResponse(): void
    {
        $response = new HtmlResponse($body = 'body');

        self::assertEquals($body, (string) $response->getBody());
        self::assertEquals(200, $response->getStatusCode());
    }

    public function test404Response(): void
    {
        $response = new HtmlResponse($body = 'empty', $status = 404);

        self::assertEquals($body, $response->getBody());
        self::assertEquals($status, $response->getStatusCode());
        self::assertEquals('Not Found', $response->getReasonPhrase());
    }

    public function testHeaders(): void
    {
        $response = (new HtmlResponse(''))
            ->withHeader($name1 = 'X-Header-1', $value1 = 'value_1')
            ->withHeader($name2 = 'X-Header-2', $value2 = 'value_2')
        ;

        self::assertEquals([
            $value1,
        ], $response->getHeader($name1));
        self::assertEquals([
            $value2,
        ], $response->getHeader($name2));
    }
}
