<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('delete a task');
$guy->sendDELETE('/tasks/1');
$guy->seeResponseCodeIs(204);

// get deleted task
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(404);