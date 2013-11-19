<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'create']);

$guy = new TestGuy($scenario);
$guy->wantTo('create a card');

// create valid task
$guy->sendPOST('/cards', [
    'name' => 'project a',
    'slug' => 'project-a'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/cards/project-a');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('{"id":3}');

// no name
$guy->sendPOST('/cards', [
    'slug' => 'project-b'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message":');

// no slug
$guy->sendPOST('/cards', [
    'name' => 'project b'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 2]);
$guy->seeResponseContains('"message":');

// duplicate slug
$guy->sendPOST('/cards', [
    'name' => 'project a',
    'slug' => 'project-a'
]);
$guy->seeResponseCodeIs(409);
$guy->seeResponseContainsJson(['code' => 3]);
$guy->seeResponseContains('"message":');

// invalid slug
$guy->sendPOST('/cards', [
    'name' => 'project ä',
    'slug' => 'project-ä'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseEquals('{"id":4}');