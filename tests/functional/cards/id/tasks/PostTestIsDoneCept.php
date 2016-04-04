<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantToTest('`isDone`-attribute');

$guy->comment('when is `true`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'isDone' => true
]);


$guy->comment('when is false');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'isDone' => false
]);


$guy->comment('when is not set');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'isDone' => false
]);


$guy->comment('when is an invalid string');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => 'abc',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'isDone' => true
]);