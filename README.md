# Dingbat

A simple todo manager

## Demo

http://dingbat.einself.net/ (will be reset every hour)

## Requirements

* PHP 5.4 and higher
* MySQL 5.1 and higher


## Installation

### Pre-Built (downloaded from SourceForge)

* import `setup/install.sql`
* copy `config.php.sample` to `config.php`
* edit `config.php`
* chmod `tmp/cache` to `777`

### Build your own release (clone from GitHub)

#### Requirements

* [Git](http://git-scm.com/)
* [Composer](http://getcomposer.org/)

#### Instructions

* `mkdir dingbat`
* `cd dingbat/`
* `git clone https://github.com/pklink/Dingbat.git .`
* _Optional:_ switch to a specified version/tag `git checkout tags/<name of tag>`; for example: `git checkout tags/0.4.0`
* `php composer.phar install`
* see the installation instuctions of the pre-built version above


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


## Changelog

### 0.4.0.1

* renamed `config.php` to `config.php.sample`
* added demo

### 0.4.0

* renamed `index.html` to `index.php`
* added I18N-support
* added German translation

### 0.3.2.1

* updated version number

### 0.3.2

* removed jquery.shake
* added required-attribute to the forms
* updated configuration of phormium/phormium

### 0.3.1

* Added message if javascript disabled
* Added sorting tasks by priority
* Added some shortcuts
    * C: Create new card/list
    * N: Create new task
    * H: Toggle helping box
* Removed [jQuery UI](http://jqueryui.com/)
* Added [jquery.shake](http://github.com/pklink/jquery.shake)

### 0.3.0.2

* Fixed version number in footer

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
* [jQuery UI](http://jqueryui.com/)
* [json2.js](http://github.com/douglascrockford/JSON-js)
* [Keycut](http://github.com/duncannz/keycut)
* [Phormium](http://github.com/ihabunek/phormium)
* [Silex](http://silex.sensiolabs.org/)
* [Underscore.js](http://underscorejs.org/)