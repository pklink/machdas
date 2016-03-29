<?php

// @group cards delete

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('delete a card');

// delete a task
$guy->sendDELETE('/cards/1');
$guy->seeResponseCodeIs(204);
$guy->sendGET('/cards/1');
$guy->seeResponseCodeIs(404);

// delete a non existing task
$guy->sendDELETE('/cards/1');
$guy->seeResponseCodeIs(204);