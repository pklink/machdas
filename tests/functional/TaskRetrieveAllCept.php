<?php

// @group cards create

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('get all tasks');

// all tasks
$guy->sendGET('/tasks');
$guy->seeResponseEquals('[{"id":1,"name":"save a whale","marked":false,"priority":"normal","cardId":1},{"id":2,"name":'
    . '"kiss a chicken","marked":false,"priority":"high","cardId":1},{"id":3,"name":"hug yourself","marked":false,'
    . '"priority":"low","cardId":1}]');

// with one filter
$guy->sendGET('/tasks/name=kiss');
$guy->seeResponseEquals('[{"id":2,"name":"kiss a chicken","marked":false,"priority":"high","cardId":1}]');

// by id
$guy->sendGET('/tasks/id=2');
$guy->seeResponseEquals('[{"id":2,"name":"kiss a chicken","marked":false,"priority":"high","cardId":1}]');

// with two filter
$guy->sendGET('/tasks/name=o;priority=low');
$guy->seeResponseEquals('[{"id":3,"name":"hug yourself","marked":false,"priority":"low","cardId":1}]');

// no results
$guy->sendGET('/tasks/name=noresult');
$guy->seeResponseEquals('[]');