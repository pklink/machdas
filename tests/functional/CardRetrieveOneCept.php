<?php

// @group cards retrieve

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get a card');

// get a card
$guy->sendGET('/cards/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'   => 1,
    'name' => 'first list',
]);

// get a non existing card
$guy->sendGET('/cards/23123');
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');
