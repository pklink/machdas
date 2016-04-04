<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get a task');
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => 1,
    'cardId'   => 1,
    'name'     => 'save a whale',
    'isDone'   => false,
    'priority' => 500,
]);
