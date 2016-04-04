<?php

// @group cards create

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);


$guy->wantTo('create valid task');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/tasks/4');
$guy->seeResponseContainsJson(['id' => 4]);
$guy->sendGET('/tasks/4');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => false,
    'priority' => 500
]);


$guy->wantTo('marked is `true`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => true,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 5]);
$guy->sendGET('/tasks/5');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => true,
    'priority' => 500
]);


$guy->wantTo('marked is not set');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 6]);
$guy->sendGET('/tasks/6');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => false,
    'priority' => 500
]);


$guy->wantTo('priority is `low`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'low'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 7]);
$guy->sendGET('/tasks/7');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => false,
    'priority' => 100
]);


$guy->wantTo('`priority` is `high`');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'high'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 8]);
$guy->sendGET('/tasks/8');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => false,
    'priority' => 900
]);


$guy->wantTo('`priority` is not set');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => false
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 9]);
$guy->sendGET('/tasks/9');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => false,
    'priority' => 500
]);


$guy->wantTo('card does not exist');
$guy->sendPOST('/cards/900/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(404);


$guy->wantTo('name is not set');
$guy->sendPOST('/cards/1/tasks', [
    'marked'   => false,
    'priority' => 'normal'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->wantTo('`priority` is invalid');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'bla'
]);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');


$guy->wantTo('`marked` is invalid');
$guy->sendPOST('/cards/1/tasks', [
    'name'     => 'something',
    'marked'   => 'asdas',
    'priority' => 'normal'
]);
$guy->seeResponseCodeIs(201);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 10]);
$guy->sendGET('/tasks/10');
$guy->seeResponseContainsJson([
    'name'     => 'something',
    'marked'   => true,
    'priority' => 500
]);
