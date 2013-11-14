<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'retrieve']);

$guy = new TestGuy($scenario);
$guy->wantTo('get all cards');

// all tasks
$guy->sendGET('/cards');
$guy->seeResponseEquals('[{"id":1,"name":"first list"},{"id":2,"name":"2nd list"}]');

// with one filter
$guy->sendGET('/cards/name=first');
$guy->seeResponseEquals('[{"id":1,"name":"first list"}]');

// by id
$guy->sendGET('/cards/id=2');
$guy->seeResponseEquals('[{"id":2,"name":"2nd list"}]');

// no results
$guy->sendGET('/tasks/name=noresult');
$guy->seeResponseEquals('[]');