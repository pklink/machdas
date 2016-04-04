<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('create a task for a non-existing card');
$guy->sendPOST('/cards/999/tasks', [
    'name'     => 'something',
    'isDone'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(404);
$guy->seeResponseJsonMatchesJsonPath('$.message');