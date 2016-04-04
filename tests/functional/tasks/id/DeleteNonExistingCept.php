<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('delete a non-existing task');
$guy->sendDELETE('/tasks/999');
$guy->seeResponseCodeIs(204);