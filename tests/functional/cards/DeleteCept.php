<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('delete a card');
$guy->sendDELETE('/cards/1');
$guy->seeResponseCodeIs(204);

// get deleted task
$guy->sendGET('/cards/1');
$guy->seeResponseCodeIs(404);

// check if tasks of card also deleted
$guy->sendGET('/tasks/1');
$guy->seeResponseCodeIs(404);
$guy->sendGET('/tasks/2');
$guy->seeResponseCodeIs(404);
$guy->sendGET('/tasks/3');
$guy->seeResponseCodeIs(404);
