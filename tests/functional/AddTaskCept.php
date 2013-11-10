<?php

$guy = new TestGuy($scenario);

$guy->wantTo('add a task');
$guy->sendPOST('/task', [
    'cardId'   => 1,
    'marked'   => false,
    'name'     => 'something',
    'priority' => 1
]);
$guy->seeResponseIsJson();
$guy->seeResponseEquals('{"id":86}');
