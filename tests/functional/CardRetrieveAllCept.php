<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['cards', 'retrieve']);

$guy = new TestGuy($scenario);
$guy->wantTo('get all cards');

// all tasks
$guy->sendGET('/cards');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[{"id":1,"name":"first list","slug":"first-list"},{"id":2,"name":"second list","slug":"second-list"}]');

/*
// with one filter
$guy->sendGET('/cards/name=first');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[{"id":1,"name":"first list","slug":"first-list"}]');

// by id
$guy->sendGET('/cards/id=2');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[{"id":2,"name":"second list","slug":"secong-list"}]');

// no results
$guy->sendGET('/tasks/name=noresult');
$guy->seeResponseIsJson();
$guy->seeResponseEquals('[]');
*/