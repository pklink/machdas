<?php

// @group cards retrieve

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get a task');

// get a task
$guy->sendGET('/tasks/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => 1,
    'cardId'   => 1,
    'name'     => 'save a whale',
    'marked'   => false,
    'priority' => 'normal',
    'code'     => 0
]);
$guy->seeResponseContains('"message":');

// get a non existing task
$guy->sendGET('/tasks/9');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code'     => 1
]);
$guy->seeResponseContains('"message":');