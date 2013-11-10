<?php

$guy = new WebGuy($scenario);
$guy->wantTo('edit a tasks');
$guy->amOnPage('/');

$oldText    = 'kiss a chicken';
$firstText  = 'kiss no chicken';
$secondText = 'kiss two chicken';

// canceling
$guy->cantSee($firstText);
$guy->click('i.foundicon-edit.update');
$guy->fillField('form > input.name', $firstText);
$guy->pressKey('form > input.name', WebDriverKeys::ESCAPE);
$guy->cantSee($firstText);

// edit by double click
$guy->see($oldText);
$guy->doubleClick('span.name');
$guy->fillField('form > input.name', $firstText);
$guy->pressKey('form > input.name', WebDriverKeys::ENTER);
$guy->see($firstText);
$guy->cantSee($oldText);

// edit by icon click
$guy->cantSee($secondText);
$guy->click('i.foundicon-edit.update');
$guy->fillField('form > input.name', $secondText);
$guy->pressKey('form > input.name', WebDriverKeys::ENTER);
$guy->cantSee($firstText);
$guy->see($secondText);
