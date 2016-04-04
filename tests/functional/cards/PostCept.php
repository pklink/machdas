<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('create a card');
$guy->sendPOST('/cards', [
    'name' => 'project a',
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseIsJson();
$guy->seeHttpHeader('Location', '/cards/3');
$guy->seeResponseContainsJson([
    'id'   => 3,
    'name' =>  'project a'
]);

// get created card
$guy->sendGET('/cards/3');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'   => 3,
    'name' => 'project a'
]);