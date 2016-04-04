<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantToTest('`name`-attribute');


$guy->comment('when is set');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'abc',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson(['name' => 'abc']);


$guy->comment('when is not set');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->comment('when is empty');
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => '',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');