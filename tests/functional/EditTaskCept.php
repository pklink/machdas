<?php

$guy = new TestGuy($scenario);
$guy->wantTo('edit a task');

$args = [
    'cardId'   => 1,
    'marked'   => false,
    'name'     => 'new name',
    'priority' => 1,
];

// edit
$guy->sendPUT('/task/1', $args);
$guy->seeResponseEquals('{"success":true}');

// edit not existing task
$guy->sendPUT('/task/4', $args);
$guy->seeResponseEquals('{"success":false,"message":"task does not exist"}');