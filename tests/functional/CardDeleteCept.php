<?php

// @group cards delete

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('delete a card');

// delete a task
$guy->sendDELETE('/cards/first-list');
$guy->seeResponseCodeIs(204);

/*
// check if tasks are deleted to
$guy->sendGET('/tasks/cardid=1');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[]');
*/

// delete a non existing task
$guy->sendDELETE('/cards/first-list');
$guy->seeResponseCodeIs(204);