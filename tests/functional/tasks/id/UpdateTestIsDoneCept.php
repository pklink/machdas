<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantToTest('`isDone`-attribute');


$guy->comment('when is to `true`');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => true]);


$guy->comment('when is to `false`');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => false]);


$guy->comment('when is not set');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => false]);


$guy->comment('when is null');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => null,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => false]);


$guy->comment('when is a string');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => 'abc',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => true]);


$guy->comment('when is an integer');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => 123,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['isDone' => true]);