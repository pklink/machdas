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
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 4]);

// check `marked`: true
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 5]);

// check without `marked`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 6]);

// check `priority`: "low"
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'low'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 7]);

// check `priority`: "high"
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'high'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 8]);

// check without `priority`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 9]);


// no cardId
$guy->sendPOST('/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseContains('"message":');

// invalid cardId
$guy->sendPOST('/tasks', [
    'cardId'   => 999,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseContains('"message":');

// no name
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseContains('"message":');

// invalid `priority`
$guy->sendPOST('/tasks', [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'bla'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseContains('"message":');