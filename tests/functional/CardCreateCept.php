<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'create']);

$guy = new TestGuy($scenario);
$guy->wantTo('create a card');

// create valid task
$guy->sendPOST('/cards', [
    'name'     => 'project a',
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseIsJson();
$guy->seeResponseEquals('{"id":3}');

// no name
$guy->sendPOST('/cards', []);
$guy->seeResponseCodeIs(400);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message":');