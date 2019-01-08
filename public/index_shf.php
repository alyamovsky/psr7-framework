<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__.'/../vendor/autoload.php';

// init

$request = Request::createFromGlobals();

// action

$path = $request->getPathInfo();

if ('/' === $path) {
    $action = function (Request $request) {
        $name = $request->query->get('name') ?? 'vasya';

        return new Response(\sprintf('hello, %s!', $name));
    };
} elseif ('/about' === $path) {
    $action = function () {
        return new Response('I am a simple site.');
    };
} elseif ('/blog' === $path) {
    $action = function () {
        return new JsonResponse([
            ['id' => 2, 'title' => 'The second post'],
            ['id' => 1, 'title' => 'The first post'],
        ]);
    };
} elseif (\preg_match('~^/blog/(?P<id>\d+)$~i', $path, $matches)) {
    $request->attributes->add(['id' => $matches['id']]);
    $action = function (Request $request) {
        if (($id = $request->attributes->get('id')) > 2) {
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

$response->headers->add(['X-Developer' => 'ddlzz']);

// send

$response->prepare($request);
$response->send();
