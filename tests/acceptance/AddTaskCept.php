<?php

$guy = new WebGuy($scenario);
$guy->wantTo('add a task');
$guy->amOnPage('/');

// add
$text = 'something';
$guy->cantSee($text);
$guy->fillField('input.name', $text);
$guy->click('+');
$guy->see($text);
