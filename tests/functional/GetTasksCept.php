<?php

$guy = new TestGuy($scenario);

$guy->wantTo('get all tasks');
$guy->sendGET('/tasks');
$guy->seeResponseEquals('[{"id":1,"name":"save a whale","marked":false,"priority":"normal","cardId":1},{"id":2,"name":'
    . '"kiss a chicken","marked":false,"priority":"high","cardId":1},{"id":3,"name":"hug yourself","marked":false,'
    . '"priority":"low","cardId":1}]');