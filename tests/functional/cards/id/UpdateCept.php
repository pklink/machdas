<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('update a card');
$guy->sendPUT('/cards/1', ['name' => 'something']);
$guy->seeResponseCodeIs(204);

// get updated card
$guy->sendGET('/cards/1');
$guy->seeResponseContainsJson(['name' => 'something']);
