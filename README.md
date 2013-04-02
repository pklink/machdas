# Dingbat

A simple todo manager as PHP-Single-Page-App


## Requirements

* PHP 5.4 and higher
* MySQL 5.1 and higher


## Installation

* import `setup/install.sql`
* edit `config.php`
* chmod `tmp/cache` to `777`


## Shorttags

### Priority

You can use the following shorttags for setting priority:

* @high
* @normal (default priority)
* @low


## Todos

- [ ] add hashtags (e.g. #project #blah ...)
- [ ] improve code


## Changelog

### 0.3.0.2

* Bugfix: Card/List doesn't work after adding

### 0.3.0.1

* Bugfix: Remove tasks doesn't work correctly

### 0.3.0

* Added cards/lists
* Added routes for cards like "#card/1" etc.
* Added [Assetic](http://github.com/kriswallsmith/assetic)
* Added @done-shorttag

### 0.2.1

* Added slidable sidebar
* Removed .htaccess for an easier configuration
* Removed [Twig](http://twig.sensiolabs.org/)

### 0.2.0

* Added priorities for tasks
* Added shorttags for tasks (@high, @normal,@low)

### 0.1.0

Initial version


## Credits

* [Assetic](http://github.com/kriswallsmith/assetic)
* [Backbone.js](http://backbonejs.org/)
* [backbone.layoutmanager](https://github.com/tbranyen/backbone.layoutmanager)
* [Foundation](http://foundation.zurb.com/)
* [jQuery](http://jquery.com/)
* [jQuery UI](http://jqueryui.com/)
* [json2.js](http://github.com/douglascrockford/JSON-js)
* [Phormium](http://github.com/ihabunek/phormium)
* [Silex](http://silex.sensiolabs.org/)
* [Underscore.js](http://underscorejs.org/)