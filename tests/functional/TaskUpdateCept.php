<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('update a task');

// update valid task
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// check `marked`: true
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// check without `marked`
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// check `priority`: "low"
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'low'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// check `priority`: "high"
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'high'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// check without `priority`
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// non existing task
$guy->sendPUT('/task/9', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message":');

// no `cardId`
$guy->sendPUT('/task/1', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 2]);
$guy->seeResponseContains('"message":');

// invalid cardId
$guy->sendPUT('/task/1', [
    'cardId'   => 999,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 3]);
$guy->seeResponseContains('"message":');

// no name
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 4]);
$guy->seeResponseContains('"message":');

// invalid `priority`
$guy->sendPUT('/task/1', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'bla'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 5]);
$guy->seeResponseContains('"message":');