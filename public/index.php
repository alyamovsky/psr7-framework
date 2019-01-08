<?php

declare(strict_types=1);

use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__.'/../vendor/autoload.php';

// init

$request = ServerRequestFactory::fromGlobals();

// action

$name = $request->getQueryParams()['name'] ?? 'vasya';

$response = (new HtmlResponse(\sprintf('hello, %s!', $name)))
    ->withHeader('X-Developer', 'ddlzz')
;

// render

$emitter = new ResponseSender();
$emitter->send($response);
