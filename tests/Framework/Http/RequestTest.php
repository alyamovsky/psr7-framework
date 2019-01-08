<?php

declare(strict_types=1);

namespace App\Tests\Framework\Http;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class RequestTest extends TestCase
{
    public function testEmptyRequest(): void
    {
        $request = (new ServerRequest())
            ->withQueryParams([])
        ;

        self::assertEquals([], $request->getQueryParams());
        self::assertNull($request->getParsedBody());
    }

    public function testQueryParams(): void
    {
        $request1 = (new ServerRequest())
            ->withQueryParams($data1 = [
                'name' => 'John',
                'age' => 23,
            ])
        ;

        $request2 = (new ServerRequest())
            ->withQueryParams($data2 = [
                'name' => 'James',
                'age' => 17,
            ])
        ;

        self::assertEquals($data1, $request1->getQueryParams());
        self::assertEquals($data2, $request2->getQueryParams());
        self::assertNull($request1->getParsedBody());
        self::assertNull($request2->getParsedBody());
    }

    public function testParsedBody(): void
    {
        $request = (new ServerRequest())
            ->withQueryParams([])
            ->withParsedBody($data = [
                'title' => 'Foobar',
            ])
        ;

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals($data, $request->getParsedBody());
    }
}
