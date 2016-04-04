<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('update a task');

// update valid task
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);

// check `isDone`: true
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);

// check without `isDone`
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(204);
// check `priority`: "low"
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'low'
]);
$guy->seeResponseCodeIs(204);

// check `priority`: "high"
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'high'
]);
$guy->seeResponseCodeIs(204);

// check without `priority`
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
]);
$guy->seeResponseCodeIs(204);

// non existing task
$guy->sendPUT('/tasks/9', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(404);
$guy->seeResponseJsonMatchesJsonPath('$.message');

// no `cardId`
$guy->sendPUT('/tasks/1', [
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');

// invalid cardId
$guy->sendPUT('/tasks/1', [
    'cardId'   => 999,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');

// no name
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');

// invalid `priority`
$guy->sendPUT('/tasks/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'bla'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');