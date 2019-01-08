<?php

declare(strict_types=1);

use Framework\Http\Response;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__.'/../vendor/autoload.php';

// init

$request = ServerRequestFactory::fromGlobals();

// action

$name = $request->getQueryParams()['name'] ?? 'vasya';

$response = (new Response(\sprintf('hello, %s!', $name)))
    ->withHeader('X-Developer', 'ddlzz')
;

// render

\header(\sprintf('HTTP/1.0 %s %s', $response->getStatusCode(), $response->getReasonPhrase()));
foreach ($response->getHeaders() as $header => $value) {
    \header(\sprintf('%s: %s', $header, $value));
}
echo $response->getBody();
