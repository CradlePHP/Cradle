# Cradle PHP
PHP Micro Framework powered by Event Pipes

## Install

`composer create-project --prefer-source --stability dev cradlephp/cradle <YOUR CUSTOM FOLDER>`

## Usage

```
//add routes here
cradle()->get(
	'/foo/bar', 
	'Get Foo Bar from database',
	array(
		'Foo Bar data Found',
		'Render Foo Bar template',
		'Render with Custom Page'
	),
	array(
		'Foo Bar data Not Found',
		'Flash error',
		'Redirect to homepage',
	)
);

...
```

If you run this nothing will happen until you ...

```
cradle()->on('Get Foo Bar from database', function() {
	//get it from the database
});

...
```

You can add sub processes too! as in ...

```
//add flows here
cradle()->flow(
	'Get Foo Bar from database', 
	'Try to get Foo Bar from Cache',
	array(
		'Foo Bar data Not Found',
		'Try to get Foo Bar from SQL'
	)
);

...
```

## Why ?

 - To clearly identify readable process flow with applied logic
 - Clearly separates functionality to units
   - Good for troubleshooting
   - Good for readbility
   - Good for packages/plugins/extensions/addons
 - Built around classes, implemented with functions
 - More than just events. You can use
   - `Controller@method`
   - `Facade::method`
   - `protocol://some-event`
   - `function() {}`
 - Create plugins as composer/packagist
 - SQL as a protocol
   - `sql://<table>-<action>-<step>` as in
   - `sql://address-create-task` and
   - `sql://address-search-data`
 - Out of the box SQL objects
   - Address
   - App
   - Authentication
   - Comment
   - Event
   - File
   - History
   - Post
   - Product
   - Profile
   - Transaction