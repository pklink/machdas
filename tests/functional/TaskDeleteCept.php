<?php

// @group cards delete

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('delete a task');

// delete a task
$guy->sendDELETE('/tasks/1');
$guy->seeResponseCodeIs(204);
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(404);

// delete a non existing task
$guy->sendDELETE('/tasks/1');
$guy->seeResponseCodeIs(204);