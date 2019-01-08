<?php

declare(strict_types=1);

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;
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
    $action = function (ServerRequest $request) {
        $name = $request->getQueryParams()['name'] ?? 'vasya';
        return new HtmlResponse(\sprintf('hello, %s!', $name));
    };
} elseif ('/about' === $path) {
    $action = function () {
        return new HtmlResponse('I am a simple site.');
    };
} elseif ('/blog' === $path) {
    $action = function () {
        return new JsonResponse([
            ['id' => 2, 'title' => 'The second post'],
            ['id' => 1, 'title' => 'The first post'],
        ]);
    };
} elseif (\preg_match('~^/blog/(?P<id>\d+)$~i', $path, $matches)) {
    $request->withAttribute('id', $matches['id']);
    $action = function (ServerRequest $request) {
        if (($id = $request->getAttribute('id')) > 2) {
            $response = new JsonResponse(['error' => 'Undefined page'], 404);
        } else {
            $response = new JsonResponse(['id' => $id, 'title' => \sprintf('Post #%d', $id)]);
        }
        return $response;
    };
} else {
    $action = function () {
        return new JsonResponse(['error' => 'Undefined page', 404]);
    };
}

$response = $action($request);

// postprocessing

$response->withHeader('X-Developer', 'ddlzz');

// send

$emitter = new SapiEmitter();
$emitter->emit($response);
