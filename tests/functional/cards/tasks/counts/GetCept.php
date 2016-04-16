<?php

// @group cards retrieve

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get all cards');

// all tasks
$guy->sendGET('/cards/tasks/count');
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(200);
$guy->seeResponseContainsJson([
    [
        'card'  => 1,
        'count' => 3
    ],
    [
        'card'  => 2,
        'count' => 0
    ]
]);
