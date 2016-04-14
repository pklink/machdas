# Changelog

## 0.7.0

* Enh: Added warning modal before deleting a task
* Enh: Added [ESlint][eslint]

## 0.6.2

* Enh: Added [Phinx][phinx] for database bootstrapping 

## 0.6.1

* Enh: Added support for [Docker][docker]
* Enh: Added Dockerfile
* Fix: webpack-dev-server doesn't work correctly if PHPs built in server bind to `localhost` instead of `127.0.0.1`

## 0.6.0

* Chg: Replaced [Backbone.js][backbone] by [Vue.js][vue]
* Chg: Replaced [Foundation][foundation] by [Semantic UI][semanticui]
* Chg: MySQL: Changed type of `tasks.priority` to integer
* Chg: MySQL: Changed name of `tasks.marked` to `tasks.isDone`
* Chg: Renamed project to "machdas"
* Chg: Set required version of PHP to >= 7.0
* Enh: Improved tests

## 0.5.1

* Enh: Improved code
* Enh: Improved tests
* Enh: Added [respect/validation][respectvalidation]

## 0.5.0

* Chg: Replaced [Silex][silex] by [Slim Framework][slim]
* Chg: RESTify resource URIs (e.g. `/task/1` to `/tasks/1`)
* Chg: Set required version of PHP to >= 5.6
* Chg: Moved backend to `/api`-resource
* Chg: Removed pklink/dotor

## 0.4.4

* Fix: #6 jquery.keycut.min.js doesn't load if Dingbat installed in a subdirectory

## 0.4.3

* Chg: Upgraded silex/silex to version 1.3.5
* Chg: Upgraded pklink/dotor to version 2.0.0
* Chg: Upgraded symfony/translation to version 3.0.3
* Chg: Replaced phormium/phormium by illuminate/database (Eloquent ORM)

## 0.4.2

* New: Added functional tests
* Enh: Normalised API
* Chg: Updated dependencies
* Chg: Replaced most of the js- and css-libraries by cdnjs.com

## 0.4.1.1

* Bug: Fixed configuration of Phormium

## 0.4.1

* Enh: #2 Make list names editable
* Enh: #3 Add configuration for name of app
* Enh: Added advanced installation instructions to README
* New: Added link to http://blog.einself.net to footer

## 0.4.0.1

* renamed `config.php` to `config.php.sample`
* added demo

## 0.4.0

* renamed `index.html` to `index.php`
* added I18N-support
* added German translation

## 0.3.2.1

* updated version number

## 0.3.2

* removed jquery.shake
* added required-attribute to the forms
* updated configuration of phormium/phormium

## 0.3.1

* Added message if javascript disabled
* Added sorting tasks by priority
* Added some shortcuts
    * C: Create new card/list
    * N: Create new task
    * H: Toggle helping box
* Removed [jQuery UI][jqueryui]
* Added jquery.shake

## 0.3.0.2

* Fixed version number in footer

## 0.3.0.2

* Bugfix: Card/List doesn't work after adding

## 0.3.0.1

* Bugfix: Remove tasks doesn't work correctly

## 0.3.0

* Added cards/lists
* Added routes for cards like "#card/1" etc.
* Added [Assetic][assetic]
* Added @done-shorttag

## 0.2.1

* Added slidable sidebar
* Removed .htaccess for an easier configuration
* Removed [Twig][twig]

## 0.2.0

* Added priorities for tasks
* Added shorttags for tasks (@high, @normal,@low)

## 0.1.0

Initial version

[assetic]: http://github.com/kriswallsmith/assetic
[backbone]: http://backbonejs.org/
[docker]: https://www.docker.com/
[eslint]: http://eslint.org/
[foundation]: http://foundation.zurb.com/
[jqueryui]: http://jqueryui.com/
[phinx]: https://phinx.org/ 
[respectvalidation]: https://github.com/Respect/Validation
[semanticui]: http://semantic-ui.com/
[silex]: http://silex.sensiolabs.org/
[slim]: http://www.slimframework.com/
[twig]: http://twig.sensiolabs.org/
[vue]: http://vuejs.org/
