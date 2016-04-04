<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get a card');
$guy->sendGET('/cards/1');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'   => 1,
    'name' => 'first list',
]);