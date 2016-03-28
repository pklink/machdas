<?php

// @group cards create

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('create a task');

// create valid task
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 4, 'code' => 0]);
$guy->seeResponseContains('"message":');

// check `marked`: true
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 5, 'code' => 0]);
$guy->seeResponseContains('"message":');

// check without `marked`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 6, 'code' => 0]);
$guy->seeResponseContains('"message":');

// check `priority`: "low"
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'low'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 7, 'code' => 0]);
$guy->seeResponseContains('"message":');

// check `priority`: "high"
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'high'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 8, 'code' => 0]);
$guy->seeResponseContains('"message":');

// check without `priority`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 9, 'code' => 0]);
$guy->seeResponseContains('"message":');


// no cardId
$guy->sendPOST('/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => null, 'code' => 1]);
$guy->seeResponseContains('"message":');

// invalid cardId
$guy->sendPOST('/tasks', [
    'cardId'   => 999,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => null, 'code' => 2]);
$guy->seeResponseContains('"message":');

// no name
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => null, 'code' => 3]);
$guy->seeResponseContains('"message":');

// invalid `priority`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'bla'
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => null, 'code' => 4]);
$guy->seeResponseContains('"message":');