<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantToTest('`priority`-attribute');


$guy->comment('when is to `normal`');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 500]);


$guy->comment('when is to `low`');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'low'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 100]);


$guy->comment('when is to `high`');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'high'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 900]);


$guy->comment('when is to 499');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 499
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 499]);


$guy->comment('when is not set');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 500]);


$guy->comment('when is null');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => null
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['priority' => 500]);


$guy->comment('when is an empty string');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => ''
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is 0');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 0
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is 1000');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 1000
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is an invalid string');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'abc'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');