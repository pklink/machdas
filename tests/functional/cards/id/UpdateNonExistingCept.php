<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('update a non-existing card');
$guy->sendPUT('/cards/999', []);
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');