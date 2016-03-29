# Dingbat [![Build Status](https://travis-ci.org/pklink/Dingbat.png?branch=master)](https://travis-ci.org/pklink/Dingbat) [![Dependency Status](https://www.versioneye.com/user/projects/5281e27e632bacc772000027/badge.png)](https://www.versioneye.com/user/projects/5281e27e632bacc772000027)

A simple todo manager

## Screenshots

![Screenshot](docs/screens/screen-1.png)

## Requirements

* PHP 5.5 and higher
* MySQL 5.1 and higher


## Installation

### Requirements

* [Git](http://git-scm.com/)
* [Composer](http://getcomposer.org/)

### Instructions

Import `setup/install.sql` to your MySQL database

```sh
git clone https://github.com/pklink/Dingbat.git
composer install
cp config.sample.php config.php
vim config.php
php -S localhost:8080 -t ./public
```

## Upgrade

See `docs/UPGRADE.md`

## Running test

```sh
composer install
php -S localhost:8080 -t ./public &
php vendor/bin/codecept run
```


## Shorttags

### Priority

You can use the following shorttags for setting priority:

* @high
* @normal (default priority)
* @low


## Todos

- [ ] add hashtags (e.g. #project #blah ...)
- [ ] improve code
- [ ] remove lists

## API

See `docs/API.md`


## Changelog

See `CHANGELOG.md`

