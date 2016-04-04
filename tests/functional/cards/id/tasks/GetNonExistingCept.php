<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get all tasks of a non-existing card');
$guy->sendGET('/cards/999/tasks');
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');