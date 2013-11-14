<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'create']);

$guy = new TestGuy($scenario);
$guy->wantTo('create a card');

// create valid task
$guy->sendPOST('/card', [
    'name'     => 'project a',
]);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 2, 'code' => 0]);
$guy->seeResponseContains('"message":');

// no name
$guy->sendPOST('/task', []);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => null, 'code' => 1]);
$guy->seeResponseContains('"message":');