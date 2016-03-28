<?php

// @group cards retrieve

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get all cards');

// all tasks
$guy->sendGET('/cards');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[{"id":1,"name":"first list"},{"id":2,"name":"second list"}]');