<?php

$name = $_GET['name'] ?? 'vasya';

\header('X-Developer: ddlzz');
echo \sprintf('hello, %s!', $name);