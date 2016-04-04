<?php

/* @var \Codeception\Scenario $scenario */

$guy = new TestGuy($scenario);
$guy->wantTo('get all tasks of a card');
$guy->sendGET('/cards/1/tasks');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson([
    [
        'id'       => 1,
        'name'     => 'save a whale',
        'isDone'   => false,
        'priority' => 500,
        'cardId'   => 1
    ], [
        'id'       => 2,
        'name'     => 'kiss a chicken',
        'isDone'   => false,
        'priority' => 900,
        'cardId'   => 1
    ], [
        'id'       => 3,
        'name'     => 'hug yourself',
        'isDone'   => false,
        'priority' => 100,
        'cardId'   => 1
    ]
]);
