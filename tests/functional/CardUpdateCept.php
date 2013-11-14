<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'update']);

$guy = new TestGuy($scenario);
$guy->wantTo('update a card');

// update valid card
$guy->sendPUT('/card/1', [
    'name' => 'something',
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 0]);
$guy->seeResponseContains('"message":');

// non existing card
$guy->sendPUT('/card/999', [
    'name' => 'something',
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message":');

// no name
$guy->sendPUT('/card/1', []);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 2]);
$guy->seeResponseContains('"message":');