# machdas [![Build Status](https://travis-ci.org/pklink/machdas.png?branch=master)](https://travis-ci.org/pklink/machdas) [![Dependency Status](https://www.versioneye.com/user/projects/5702b434fcd19a00415b0081/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5702b434fcd19a00415b0081) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pklink/machdas/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pklink/machdas/?branch=master)

Todo manager based on PHP 7, [Slim](http://www.slimframework.com/) and [Vue.js](http://vuejs.org/).

[Demo](https://machdas.dev.klink.xyz/)

## Shorttags

### Priority

You can use the following shorttags for setting priority:

* `@high`
* `@normal` (default priority)
* `@low`

### Status

Use `@done` to mark a task as complete


## Installation

### Docker

```
docker run --link mysql -e MD_MYSQL_HOST=mysql -p 80:80 pklink/machdas
```

Available environment variables are:

* `MD_MYSQL_HOST` (default: `mysql`)
* `MD_MYSQL_USERNAME` (default: `root`)
* `MD_MYSQL_PASSWORD` (default: `password`)
* `MD_MYSQL_DATABASE` (default: `machdas`)

### Manual Installation

#### Requirements

* PHP 7.0 and higher
* MySQL 5.1 and higher
* [Composer](http://getcomposer.org/)
* [npm](https://www.npmjs.com/)

#### Instructions

```sh
wget https://github.com/pklink/machdas/archive/<LATEST_VERSION>.tar.gz
tar xzf <LATEST_VERSION>.tar.gz
cd machdas-<LATEST_VERSION>
composer install
cp config.sample.php config.php
vim config.php
npm install
npm run build
php vendor/bin/phinx migrate -e prod
php -S localhost:9000 -t ./public
```

## Upgrade

```sh
php vendor/bin/phinx migrate -e prod
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
php vendor/bin/phinx migrate -e dev
php -S 127.0.0.1:9000 -t ./public &
npm start
```

Open http://localhost:8080/ or http://localhost:8080/webpack-dev-server/
 
### Running test

#### Backend

```sh
composer install
php -S localhost:9000 -t ./public &
php vendor/bin/codecept run
php vendor/bin/phpcs --standard=PSR2 backend/ public/api/index.php 
```

#### Frontend

```sh
npm install
node_modules/.bin/eslint frontend/
```

## Changelog

See `CHANGELOG.md`

