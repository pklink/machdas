# API

## Tasks

### Create a new task

#### Request

* URL: `api/index.php/tasks`
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

			
#### Example

##### Request

POST to `api/index.php/tasks` with payload:

	{
		"name": "blah",
		"marked": false,
		"priority": "high",
		"cardId": 1
	}
	
##### Response

	{
		"id": 4,
	}

***

### Retrieve a task

#### Request

* URL: `api/index.php/tasks/<id>`
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
		
#### Example

##### Request

GET to `api/index.php/tasks/1`

##### Response

	{
		"id": 1,
		"cardId": 1,
		"name": "blah",
		"marked": false,
		"priority": "high",
	}

***

### Retrieve all/more tasks

#### Request

* URL: `api/index.php/tasks`
* Method: `GET`
	
		
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

GET to `api/index.php/tasks`

##### Response

	[
		{
			"id": 1,
			"cardId": 1,
			"name": "save a whale",
			"marked": false,
			"priority": "high"
		},
		{
			"id": 2,
			"cardId": 1,
			"name": "kiss a chicken",
			"marked": false,
			"priority": "normal"
		},
		{
			"id": 3,
			"cardId": 1,
			"name": "do something",
			"marked": false,
			"priority": "low"
		}
	]

***


### Update a task

#### Request

* URL: `api/index.php/tasks/<id>`
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

#### Example

##### Request

PUT to `api/index.php/tasks/1` with payload:

	{
		"name": "blah",
		"marked": false,
		"priority": "high",
		"cardId": 1
	}
	
##### Response

	{
		"message": "all fine"
	}

***

### Delete a task

#### Request

* URL: `api/index.php/tasks/<id>`
* Method: `DELETE`
* Params:
	*  `id` in URL
		* type: `integer`
		* description: id of the task
		
#### Response
			
#### Example

##### Request

DELETE to `api/index.php/tasks/1`

	
##### Response


## Cards / Lists

### Create a new card

#### Request

* URL: `api/index.php/cards`
* Method: `POST`
* Params:
	* `name`:
		* type: `string`
		* required: yep

#### Response

* `id`
	* type: `integer` or `null` on error
	* decription: ID of the new card
* `message`:
	* type: `string`


#### Example

##### Request

POST to `api/index.php/cards` with payload:

	{
		"name": "job",
	}

##### Response

	{
		"id": 4,
	}

***


### Retrieve a card

#### Request

* URL: `api/index.php/cards/<id>`
* Method: `GET`
* Params:
	* `id`: in URL
		* type: `integer`
		* required: yep
		* description: ID of the card
		* example: `1`

#### Response

* `id`:
	* type: `integer` or `null` on error
	* description: ID of the task
* `name`:
	* type: `string` or `null` on error
	* description: name of the card

#### Example

##### Request

GET to `api/index.php/cards/1`

##### Response

	{
		"id": 1,
		"name": "blah",
	}

***

### Retrieve all cards

#### Request

* URL: `api/index.php/cards`
* Method: `GET`


#### Response

Array with cards as elements. Every card has this structure:

* `id`:
	* type: `integer`
	* description: ID of the task
* `name`:
	* type: `string`
	* description: name of the task

#### Example

##### Request

GET to `api/index.php/cards`

##### Response

	[
		{
			"id": 1,
			"name": "private"
		},
		{
			"id": 2,
			"name": "job"
        }
		},
			"id": 3,
			"name": "blah"
		}
	]

***


### Update a card

#### Request

* URL: `api/index.php/cards/<id>`
* Method: `PUT`
* Params:
	*  `id` in URL
		* type: `integer`
		* description: id of the task
	* `name`:
		* type: `string`
		* required: yep

#### Response


#### Example

##### Request

PUT to `api/index.php/cards/1` with payload:

	{
		"name": "blah",
	}

##### Response

***


### Delete a card

#### Request

* URL: `api/index.php/cards/<id>`
* Method: `DELETE`
* Params:
	*  `id` in URL
		* type: `integer`
		* description: id of the card

#### Response

#### Example

##### Request

DELETE to `api/index.php/cards/1`

##### Response