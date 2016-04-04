<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('create a task');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/tasks/4');
$guy->seeResponseContainsJson([
    'id'       => 4,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 500
]);

// get created task
$guy->sendGET('/tasks/4');
$guy->seeResponseContainsJson([
    'id'       => 4,
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 500
]);