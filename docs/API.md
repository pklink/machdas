# API

## Tasks

### Create a new task

#### Request

* URL: `index.php/task`
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
		
#### Response

* `id`
	* type: `integer` or `null` on error
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

			
#### Example

##### Request

POST to `index.php/task` with payload:

	{
		"name": "blah",
		"marked": false,
		"priority": "high",
		"cardId": 1
	}
	
##### Response

	{
		"id": 4,
		"code": 0,
		"message": "all fine"
	}

***

### Retrieve a task

#### Request

* URL: `index.php/task/<id>`
* Method: `GET`
* Params:
	* `id`:
		* type: `integer`
		* required: yep
		* description: ID of the task
		* example: `1`
		
#### Response

* `id`:
	* type: `integer` or `null` on error
	* description: ID of the task
* `cardId`
	* type: `integer` or `null` on error
	* description: ID of the card
* `name`:
	* type: `string` or `null` on error
	* description: name of the task	
* `marked`:
	* type: `boolean` or `null` on error
* `priority`:
	* type: `string` or `null` on error
	* possible values: `normal`, `high`, `low`
* `code`:
	* type: `integer`
	* possible values:
		* `0`: all fine
		* `1`:  task with given ID does not exist
* `message`:
	* type: `string`
		
#### Example

##### Request

GET to `index.php/task/1`

##### Response

	{
		"id": 1,
		"cardId": 1,
		"name": "blah",
		"marked": false,
		"priority": "high",
		"code": 0,
		"message": "all fine"
	}

***