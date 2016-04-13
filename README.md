# machdas [![Build Status](https://travis-ci.org/pklink/machdas.png?branch=master)](https://travis-ci.org/pklink/machdas) [![Dependency Status](https://www.versioneye.com/user/projects/5702b434fcd19a00415b0081/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5702b434fcd19a00415b0081) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pklink/machdas/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pklink/machdas/?branch=master)

Todo manager based on PHP 7, [Slim](http://www.slimframework.com/) and [Vue.js](http://vuejs.org/).

## Shorttags

### Priority

You can use the following shorttags for setting priority:

* `@high`
* `@normal` (default priority)
* `@low`

### Status

Use `@done` to mark a task as complete


## Installation

### Requirements

* PHP 7.0 and higher
* MySQL 5.1 and higher
* [Composer](http://getcomposer.org/)
* [npm](https://www.npmjs.com/)

### Instructions

Import `setup/install.sql` to your MySQL database

```sh
wget https://github.com/pklink/machdas/archive/<LATEST_VERSION>.tar.gz
tar xzf <LATEST_VERSION>.tar.gz
cd machdas-<LATEST_VERSION>
composer install
cp config.sample.php config.php
vim config.php
npm install
npm run build
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

## Set up development environment

Import `setup/install.sql` to your MySQL database

```sh
git clone git@github.com:pklink/machdas.git
cd machdas
composer install
cp config.sample.php config.php
vim config.php
npm install
php -S localhost:9000 -t ./public &
npm start
```

Frontend runs on localhost:8080 and backend on localhost:9000

## Changelog

See `CHANGELOG.md`

