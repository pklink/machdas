# Selleck.todo

A simple todo manager


## Requirement

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

## Todos

* add several lists (e.g. job, private ...)
* add hashtags (e.g. #project #blah ...)
* add priority (high, normal, low)
* add shorttags (e.g. @high, @normal, @low)
* improve code
* remove twig


## Credits

* [Backbone.js](http://backbonejs.org/)
* [Foundation](http://foundation.zurb.com/)
* [jQuery](http://jquery.com/)
* [json2.js](http://github.com/douglascrockford/JSON-js)
* [Phormium](https://github.com/ihabunek/phormium)
* [Silex](http://silex.sensiolabs.org/)
* [Twig](http://twig.sensiolabs.org/)
* [Underscore.js](http://underscorejs.org/)