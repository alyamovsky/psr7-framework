<?php

declare(strict_types=1);

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\Router;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__.'/../vendor/autoload.php';

// init

$routes = new RouteCollection();

$routes->get('home', '/', function (ServerRequestInterface $request) {
    $name = $request->getQueryParams()['name'] ?? 'vasya';

    return new HtmlResponse(\sprintf('hello, %s!', $name));
});

$routes->get('about', '/about', $action = function () {
    return new HtmlResponse('I am a simple site.');
});

$routes->get('blog', '/blog', function () {
    return new JsonResponse([
        ['id' => 2, 'title' => 'The second post'],
        ['id' => 1, 'title' => 'The first post'],
    ]);
});

$routes->get('blog_show', '/blog{id}', function (ServerRequestInterface $request) {
    if (($id = $request->getAttribute('id')) > 2) {
        $response = new JsonResponse(['error' => 'Undefined page'], 404);
    } else {
        $response = new JsonResponse(['id' => $id, 'title' => \sprintf('Post #%d', $id)]);
    }

    return $response;
}, ['id' => '\d+']);

$router = new Router($routes);

// running

$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($request->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }

    /** @var callable $action */
    $action = $result->getHandler();
    /** @noinspection PhpMethodParametersCountMismatchInspection */
    $response = $action($request);
} catch (RequestNotMatchedException $e) {
    $response = new JsonResponse(['error' => 'Undefined page', 404]);
}

// postprocessing

$response->withHeader('X-Developer', 'ddlzz');

// send

$emitter = new SapiEmitter();
$emitter->emit($response);
