<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'update']);

$guy = new TestGuy($scenario);
$guy->wantTo('update a card');

// update name
$guy->sendPUT('/cards/first-list', [
    'name' => 'something',
]);
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['uri' => '/cards/first-list']);

// update slug
$guy->sendPUT('/cards/first-list', [
    'slug' => 'something',
]);
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['uri' => '/cards/something']);

// update name and slug
$guy->sendPUT('/cards/something', [
    'name' => 'another thing',
    'slug' => 'another-thing',
]);
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['uri' => '/cards/another-thing']);

// no attributes
$guy->sendPUT('/cards/second-list', []);
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['uri' => '/cards/second-list']);

// duplicate slug
$guy->sendPUT('/cards/second-list', [
    'slug' => 'another-thing'
]);
$guy->seeResponseCodeIs(409);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 4]);
$guy->seeResponseContains('"message":');

// duplicate slug
$guy->sendPUT('/cards/second-list', [
    'slug' => 'second-list'
]);
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['uri' => '/cards/second-list']);

// non existing card
$guy->sendPUT('/cards/blabla', [
    'name' => 'something',
]);
$guy->seeResponseCodeIs(404);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message":');
