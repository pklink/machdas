# Selleck.todo

A simple todo manager as PHP-Single-Page-App


## Requirements

* PHP 5.4 and higher
* MySQL 5.1 and higher


## Installation

* import `setup/install.sql`
* edit `config.php`
* set the `RewriteBase` in `.htaccess` to the subfolder on your webserver or remove the line if you run Selleck.todo
from the the root folder
    * `http://example.com/todo` set `RewriteBase` to `/todo`
    * `http://example.com/selleck/todo` set `RewriteBase` to `/selleck/todo`
    * `http://example.com` remove the `RewriteBase` line
    * you find more information and instructions for other servers [here](http://silex.sensiolabs.org/doc/web_servers.html)


## Shorttags

### Priority

You can use the following shorttags for setting priority:

* @high
* @normal (default priority)
* @low


## Todos

- [ ] add several lists (e.g. job, private ...)
- [ ] add hashtags (e.g. #project #blah ...)
- [x] <del>add priority (high, normal, low)</del> (added in version 0.2.0)
- [x] <del>add shorttags (e.g. @high, @normal, @low)</del> (added in version 0.2.0)
- [ ] improve code
- [ ] remove twig


## Changelog

### 0.2.1

* Added slidable sidebar

### 0.2.0

* Added priorities for tasks
* Added shorttags for tasks (@high, @normal,@low)

### 0.1.0

Initial version


## Credits

* [Backbone.js](http://backbonejs.org/)
* [Foundation](http://foundation.zurb.com/)
* [jQuery](http://jquery.com/)
* [jQuery UI](http://jqueryui.com/)
* [json2.js](http://github.com/douglascrockford/JSON-js)
* [Phormium](https://github.com/ihabunek/phormium)
* [Silex](http://silex.sensiolabs.org/)
* [Twig](http://twig.sensiolabs.org/)
* [Underscore.js](http://underscorejs.org/)