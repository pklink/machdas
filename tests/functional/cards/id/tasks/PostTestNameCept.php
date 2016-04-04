<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantToTest('`name`-attribute');

$guy->comment('when is set');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson([
    'name' => 'something',
]);


$guy->comment('when is not set');
$guy->sendPOST('/cards/1/tasks', [
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is empty');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => '',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');