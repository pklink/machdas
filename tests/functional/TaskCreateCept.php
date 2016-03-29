<?php

// @group cards create

/* @var \Codeception\Scenario $scenario */
$guy = new TestGuy($scenario);
$guy->wantTo('create a task');

// create valid task
$request = [
    'cardId'   => 1,
    'name'     => 'something',
    'marked'   => false,
    'priority' => 'normal'
];
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/tasks/4');
$guy->seeResponseContainsJson(['id' => 4]);
$guy->sendGET('/tasks/4');
$guy->seeResponseContainsJson($request);

// check `marked`: true
$request['marked'] = true;
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 5]);
$guy->sendGET('/tasks/5');
$guy->seeResponseContainsJson($request);

// check without `marked`
unset($request['marked']);
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 6]);
$request['marked'] = false;
$guy->sendGET('/tasks/6');
$guy->seeResponseContainsJson($request);

// check `priority`: "low"
$request['priority'] = 'low';
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 7]);
$guy->sendGET('/tasks/7');
$guy->seeResponseContainsJson($request);

// check `priority`: "high"
$request['priority'] = 'high';
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 8]);
$guy->sendGET('/tasks/8');
$guy->seeResponseContainsJson($request);

// check without `priority`
unset($request['priority']);
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(201);
$guy->seeResponseContainsJson(['id' => 9]);
$request['priority'] = 'normal';
$guy->sendGET('/tasks/9');
$guy->seeResponseContainsJson($request);

// no cardId
unset($request['cardId']);
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');

// invalid cardId
$request['cardId'] = 999;
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');
$request['cardId'] = 1;

// no name
unset($request['name']);
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');
$request['name'] = 'a name';

// invalid `priority`
$request['priority'] = 'bla';
$guy->sendPOST('/tasks', $request);
$guy->seeResponseIsJson();
$guy->seeResponseCodeIs(400);
$guy->seeResponseJsonMatchesJsonPath('$.message');
$request['priority'] = 'normal';


// invalid `marked`
$request['marked'] = 'asdasd';
$guy->sendPOST('/tasks', $request);
$guy->seeResponseCodeIs(201);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['id' => 10]);
$request['marked'] = true;
$guy->sendGET('/tasks/10');
$guy->seeResponseContainsJson($request);
