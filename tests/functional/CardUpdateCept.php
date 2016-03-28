<?php

// @group cards update

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('update a card');

// update name
$guy->sendPUT('/cards/first-list', [
    'name' => 'something',
]);
$guy->seeResponseCodeIs(204);

// update slug
$guy->sendPUT('/cards/first-list', [
    'slug' => 'something',
]);
$guy->seeResponseCodeIs(204);

// update name and slug
$guy->sendPUT('/cards/something', [
    'name' => 'another thing',
    'slug' => 'another-thing',
]);
$guy->seeResponseCodeIs(204);

// no attributes
$guy->sendPUT('/cards/second-list', []);
$guy->seeResponseCodeIs(204);

// duplicate slug
$guy->sendPUT('/cards/second-list', [
    'slug' => 'another-thing'
]);
$guy->seeResponseCodeIs(409);
$guy->seeResponseIsJson();
$guy->seeResponseContains('"message":');

// duplicate slug
$guy->sendPUT('/cards/second-list', [
    'slug' => 'second-list'
]);
$guy->seeResponseCodeIs(204);

// non existing card
$guy->sendPUT('/cards/blabla', [
    'name' => 'something',
]);
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseContains('"message":');
