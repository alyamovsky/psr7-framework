<?php

declare(strict_types=1);

use Framework\Http\Request;

require __DIR__.'/../vendor/autoload.php';

// init

$request = new Request();

$name = $request->getQueryParams()['name'] ?? 'vasya';

\header('X-Developer: ddlzz');
echo \sprintf('hello, %s!', $name);
