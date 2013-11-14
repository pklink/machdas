<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'delete']);

$guy = new TestGuy($scenario);
$guy->wantTo('delete a card');

// delete a task
$guy->sendDELETE('/card/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code' => 0,
]);
$guy->seeResponseContains('"message":');

// check if tasks are deleted to
$guy->sendGET('/tasks/cardid=1');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[]');

// delete card with no tasks
// delete a task
$guy->sendDELETE('/card/2');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code' => 0,
]);
$guy->seeResponseContains('"message":');

// delete a non existing task
$guy->sendGET('/card/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'code' => 1
]);
$guy->seeResponseContains('"message":');