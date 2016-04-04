# Dingbat [![Build Status](https://travis-ci.org/pklink/Dingbat.png?branch=master)](https://travis-ci.org/pklink/Dingbat) [![Dependency Status](https://www.versioneye.com/user/projects/5281e27e632bacc772000027/badge.png)](https://www.versioneye.com/user/projects/5281e27e632bacc772000027) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pklink/Dingbat/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pklink/Dingbat/?branch=master)

Todo manager based on [Vue.js](http://vuejs.org/) and [Slim](http://www.slimframework.com/)

## Shorttags

### Priority

You can use the following shorttags for setting priority:

* `@high`
* `@normal` (default priority)
* `@low`

### Status

Use `@done` to mark a task as complete


## Requirements

* PHP 5.6 and higher
* MySQL 5.1 and higher


## Installation

### Requirements

* [Composer](http://getcomposer.org/)
* [npm](https://www.npmjs.com/)

### Instructions

Import `setup/install.sql` to your MySQL database

```sh
wget https://github.com/pklink/Dingbat/archive/<VERSION>.tar.gz
tar xzf Dingbat-<VERSION>.tar.gz
cd Dingbat-<VERSION>
composer install
cp config.sample.php config.php
vim config.php
npm install
npm build
php -S localhost:9000 -t ./public
```

## Upgrade

### to 0.6.0

* execute `setup/update-to-0.6.0.sql`

### to 0.5.1

* change the following keys in your `config.php`
    * `database` to `db`
    * `db.name` to `db.database`
* add the following keys and values to your `config.php`
    * key: `driver` value: `'mysql'`
    * key: `charset` value: `'utf8'`
    * key: `collation` value: `'utf8_unicode_ci'`
    * key: `prefix` value: `''`
* execute `setup/update-to-0.5.1.sql`

### to 0.4.2

* write down your set priorities
* execute `setup/update-to-0.4.2.sql`
* set your priorities again - sorry

### to 0.4.1

* add key/config `name` to your `config.php` (default value is `Dingbat`)

### to 0.3.0

* execute `setup/update-to-0.3.0.sql`

### to 0.2.0

* execute `setup/update-to-0.2.0.sql`

## Running test

```sh
composer install
php -S localhost:9000 -t ./public &
php vendor/bin/codecept run
```


## Todos

- [ ] add hashtags (e.g. #project #blah ...)
- [ ] remove lists
- [ ] add users
- [ ] add Swagger specification

## Changelog

See `CHANGELOG.md`

