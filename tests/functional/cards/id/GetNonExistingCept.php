<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get a non-existing card');
$guy->sendGET('/cards/999');
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');
