<?php

declare(strict_types=1);

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
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
} elseif ('/blog' === $path) {
    $response = new JsonResponse([
        ['id' => 2, 'title' => 'The second post'],
        ['id' => 1, 'title' => 'The first post'],
    ]);
} elseif (\preg_match('~^/blog/(?P<id>\d+)$~i', $path, $matches)) {
    $id = $matches['id'];
    if ($id > 2) {
        $response = new JsonResponse(['error' => 'Undefined page'], 404);
    } else {
        $response = new JsonResponse(['id' => $id, 'title' => \sprintf('Post #%d', $id)]);
    }
} else {
    $response = new JsonResponse(['error' => 'Undefined page', 404]);
}

// postprocessing

$response->withHeader('X-Developer', 'ddlzz');

// send

$emitter = new SapiEmitter();
$emitter->emit($response);
