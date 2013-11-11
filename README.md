# Dingbat

A simple todo manager

## Demo

http://dingbat.einself.net/ (will be reset every hour)

## Requirements

* PHP 5.4 and higher
* MySQL 5.1 and higher


## Installation

See `INSTALLATION.md`


## Upgrade

See `INSTALLATION.md`


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

### Tasks

#### Create a new task

##### Request

* Url: `index.php/task`
* Method: `POST`
* Params:
	* `cardId`: 
		* type: `integer`
		* required: yep
		* example: `1`
	* `name`: 
		* type: `string`
		* required: yep
	* `marked`: 
		* type: `boolean` 
		* required: nop
		* default: `false`
	* `priority`: 
		* type: `string` 
		* required: nop
		* available values: `normal`, `high`, `low`
		
##### Response

* `id`
	* type: `integer` or `null` if exist an error
	* decription: ID of the new task
* `code`
	* type: `integer`
	* possible values:
		* `0`: all fine
		* `1`: `cardId` is not given in request
		* `2`: card with id `cardId` does not exist
		* `3`: `name` is not given in request
		* `4`: given `priority` is invalid
		* `999`: unknown error
* `message`:
	* type: `string`

			
##### Example

POST to `index.php/task` with payload `{"name":"blah","marked":false,"priority":"high","cardId":1}` response `{"id":4}`


## Changelog

See `CHANGELOG.md`

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