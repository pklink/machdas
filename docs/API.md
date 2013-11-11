# API

## Tasks

### Create a new task

#### Request

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
		
#### Response

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

			
#### Example

POST to `index.php/task` with payload `{"name":"blah","marked":false,"priority":"high","cardId":1}` response `{"id":4}`