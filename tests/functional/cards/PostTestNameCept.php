<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('create a card without a name');
$guy->sendPOST('/cards', []);
$guy->seeResponseCodeIs(400);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');