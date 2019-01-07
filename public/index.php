<?php

declare(strict_types=1);

use Framework\Http\RequestFactory;

require __DIR__.'/../vendor/autoload.php';

// init

$request = RequestFactory::fromGlobals();

// action

$name = $request->getQueryParams()['name'] ?? 'vasya';

\header('X-Developer: ddlzz');
echo \sprintf('hello, %s!', $name);
