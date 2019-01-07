<?php

declare(strict_types=1);

use Framework\Http\RequestFactory;
use Framework\Http\Response;

require __DIR__.'/../vendor/autoload.php';

// init

$request = RequestFactory::fromGlobals();

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
