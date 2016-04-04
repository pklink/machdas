<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('update a card without a name');
$guy->sendPUT('/cards/1', []);
$guy->seeResponseCodeIs(204);
$guy->sendGET('/cards/1');
$guy->seeResponseContainsJson(['name' => 'first list']);
