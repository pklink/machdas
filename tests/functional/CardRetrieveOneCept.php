<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'retrieve']);

$guy = new TestGuy($scenario);
$guy->wantTo('get a card');

// get a card
$guy->sendGET('/card/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => 1,
    'name'     => 'first list',
    'code'     => 0
]);
$guy->seeResponseContains('"message":');

// get a non existing card
$guy->sendGET('/task/999');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => null,
    'name'     => null,
    'code'     => 1
]);
$guy->seeResponseContains('"message":');