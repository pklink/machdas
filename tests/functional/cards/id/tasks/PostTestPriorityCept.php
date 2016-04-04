<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantToTest('`priority`-attribute');

$guy->comment('when is `normal`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'priority' => 500
]);


$guy->comment('when is `low`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'low'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'priority' => 100
]);


$guy->comment('when is `high`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'high'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'priority' => 900
]);


$guy->comment('when is `499`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 499
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'priority' => 499
]);


$guy->comment('when is not set');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'priority' => 500
]);


$guy->comment('when is `0`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 0
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is `1000`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 1000
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is an invalid string');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'abc'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');