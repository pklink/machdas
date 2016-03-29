<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('update a card');

// update name
$guy->sendPUT('/cards/1', ['name' => 'something']);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/cards/1');
$guy->seeResponseContainsJson(['name' => 'something']);

// no attributes
$guy->sendPUT('/cards/1', []);
$guy->seeResponseCodeIs(204);

// non existing card
$guy->sendPUT('/cards/2131312', ['name' => 'something']);
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseJsonMatchesJsonPath('$.message');
