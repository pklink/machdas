<?php

// @group cards delete

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('delete a task');

// delete a task
$guy->sendDELETE('/tasks/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code' => 0,
]);
$guy->seeResponseContains('"message":');

// delete a non existing task
$guy->sendGET('/tasks/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code' => 0
]);
$guy->seeResponseContains('"message":');