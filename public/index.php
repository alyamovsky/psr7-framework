<?php

declare(strict_types=1);

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__.'/../vendor/autoload.php';

// init

$request = ServerRequestFactory::fromGlobals();

// action

$name = $request->getQueryParams()['name'] ?? 'vasya';

$response = (new HtmlResponse(\sprintf('hello, %s!', $name)))
    ->withHeader('X-Developer', 'ddlzz')
;

// send

$emitter = new SapiEmitter();
$emitter->emit($response);
