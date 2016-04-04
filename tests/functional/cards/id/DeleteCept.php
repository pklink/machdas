<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('delete a card');
$guy->sendDELETE('/cards/1');
$guy->seeResponseCodeIs(204);

// get deleted card
$guy->sendGET('/cards/1');
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');