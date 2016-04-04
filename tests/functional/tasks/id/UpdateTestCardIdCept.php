<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantToTest('`cardId`-attribute');


$guy->comment('when is to another card');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 2,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['cardId' => 2]);


$guy->comment('when is not set');
$guy->sendPUT('/tasks/1', [
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is null');
$guy->sendPUT('/tasks/1', [
    'cardId'   => null,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is empty');
$guy->sendPUT('/tasks/1', [
    'cardId'   => '',
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is a string');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 'abc',
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');