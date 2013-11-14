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
	* `id`: in URL
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

### Retrieve all tasks

#### Request

* URL: `index.php/tasks/(<filter>)`
* Method: `GET`
* Params: 
	* type: `string`
	* required: nop
	* possible values: search terms as `<attribute name>/<search value>` separated by `;`
	* example: `index.php/tasks/name=kiss;marked=false`
	
		
#### Response

Array with tasks as elements. Every task has this structure:

* `id`:
	* type: `integer`
	* description: ID of the task
* `cardId`
	* type: `integer`
	* description: ID of the card
* `name`:
	* type: `string`
	* description: name of the task	
* `marked`:
	* type: `boolean`
* `priority`:
	* type: `string`
	* possible values: `normal`, `high`, `low`
		
#### Example

##### Request

GET to `index.php/tasks`

##### Response

	[
		{
			"id": 1,
			"cardId": 1,
			"name": "save a whale",
			"marked": false,
			"priority": "high",
		},
		{
			"id": 2,
			"cardId": 1,
			"name": "kiss a chicken",
			"marked": false,
			"priority": "normal",
		},
			"id": 3,
			"cardId": 1,
			"name": "do something",
			"marked": false,
			"priority": "low",
		}
	]

***


### Update a task

#### Request

* URL: `index.php/task/<id>`
* Method: `PUT`
* Params:
	*  `id` in URL
		* type: `integer`
		* description: id of the task
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

* `code`
	* type: `integer`
	* possible values:
		* `0`: all fine
		* `1`: task does not exist
		* `2`: `cardId` is not given in request
		* `3`: card with id `cardId` does not exist
		* `4`: `name` is not given in request
		* `5`: given `priority` is invalid
		* `999`: unknown error
* `message`:
	* type: `string`

			
#### Example

##### Request

PUT to `index.php/task/1` with payload:

	{
		"name": "blah",
		"marked": false,
		"priority": "high",
		"cardId": 1
	}
	
##### Response

	{
		"code": 0,
		"message": "all fine"
	}

***

### Delete a task

#### Request

* URL: `index.php/task/<id>`
* Method: `DELETE`
* Params:
	*  `id` in URL
		* type: `integer`
		* description: id of the task
		
#### Response

* `code`
	* type: `integer`
	* possible values:
		* `0`: all fine
		* `1`: task does not exist
		* `999`: unknown error
* `message`:
	* type: `string`

			
#### Example

##### Request

DELETE to `index.php/task/1`

	
##### Response

	{
		"code": 0,
		"message": "all fine"
	}


## Cards / Lists

### Create a new card

#### Request

* URL: `index.php/card`
* Method: `POST`
* Params:
	* `name`:
		* type: `string`
		* required: yep

#### Response

* `id`
	* type: `integer` or `null` on error
	* decription: ID of the new card
* `code`
	* type: `integer`
	* possible values:
		* `0`: all fine
		* `1`: `name` is not given in request
		* `999`: unknown error
* `message`:
	* type: `string`


#### Example

##### Request

POST to `index.php/card` with payload:

	{
		"name": "job",
	}

##### Response

	{
		"id": 4,
		"code": 0,
		"message": "all fine"
	}

***


