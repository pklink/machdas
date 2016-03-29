<?php

// @group cards create

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get all tasks');

// all tasks
$guy->sendGET('/tasks');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    [
        'id'       => 1,
        'name'     => 'save a whale',
        'marked'   => false,
        'priority' => 'normal',
        'cardId'   => 1
    ], [
        'id'       => 2,
        'name'     => 'kiss a chicken',
        'marked'   => false,
        'priority' => 'high',
        'cardId'   => 1
    ], [
        'id'       => 3,
        'name'     => 'hug yourself',
        'marked'   => false,
        'priority' => 'low',
        'cardId'   => 1
    ]
]);
