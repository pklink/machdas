<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get a non-existing task');
$guy->sendGET('/tasks/999');
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(404);
$guy->seeResponseJsonMatchesJsonPath('$.message');
