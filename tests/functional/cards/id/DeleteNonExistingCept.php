<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('delete a non-existing card');
$guy->sendDELETE('/cards/999');
$guy->seeResponseCodeIs(204);