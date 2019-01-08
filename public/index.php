<?php

declare(strict_types=1);

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__.'/../vendor/autoload.php';

// init

$request = ServerRequestFactory::fromGlobals();

// pre-processing

if (false !== \stripos($request->getHeaderLine('Content-Type'), 'json')) {
    $request = $request->withParsedBody(\json_decode($request->getBody()->getContents()));
}

// action

$path = $request->getUri()->getPath();

if ('/' === $path) {
    $name = $request->getQueryParams()['name'] ?? 'vasya';
    $response = new HtmlResponse(\sprintf('hello, %s!', $name));
} elseif ('/about' === $path) {
    $response = new HtmlResponse('I am a simple site.');
} else {
    $response = new \Zend\Diactoros\Response\JsonResponse(['error' => 'Undefined page', 404]);
}

// postprocessing

$response->withHeader('X-Developer', 'ddlzz');

// send

$emitter = new SapiEmitter();
$emitter->emit($response);
