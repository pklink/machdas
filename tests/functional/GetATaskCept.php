<?php

$guy = new TestGuy($scenario);
$guy->wantTo('get a task');

// get a task
$guy->sendGET('/task/1');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => 1,
    'cardId'   => 1,
    'name'     => 'save a whale',
    'marked'   => false,
    'priority' => 'normal',
    'code'     => 0
]);
$guy->seeResponseContains('"message":');

// get a non existing task
$guy->sendGET('/task/9');
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    'id'       => null,
    'cardId'   => null,
    'name'     => null,
    'marked'   => null,
    'priority' => null,
    'code'     => 1
]);
$guy->seeResponseContains('"message":');