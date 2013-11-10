<?php

$guy = new WebGuy($scenario);
$guy->wantTo('delete a tasks');
$guy->amOnPage('/');

$element = 'i.foundicon-trash.delete';

// delete
$text = 'kiss a chicken';
$guy->see($text);
$guy->click($element);
$guy->wait(1);
$guy->cantSee($text);

// delete other tasks
$guy->click($element);
$guy->click($element);
$guy->see('no tasks! nothin\' to do?');
