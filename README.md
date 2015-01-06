#Smark.io API
=========================

An accelerator to communicate with © Smark.io API to manage Lead Relations

Installation and usage with Composer
----------


Add the following to your composer.json file in order to fetch the latest stable version of the project:

```
{
    "require": {
        "smarkio/smarkio-api-client": "*"
    }
}
```

Then, in order to use the accelerator on your own PHP file, add the following:

```
require '[COMPOSER_VENDOR_PATH]/autoload.php';
```


Contents
--------

- src/Smarkio/API - Code to interact with the Smarkio Internal API.
- examples/ - Some examples on how to use this accelerator.

Before you start
----------------

You need to obtain one API token to use the API. This token is bound to each user of the Smark.io system details.


# Usage

## Create a Lead Relation


```
$api_token = 'YOUR API TOKEN HERE';
$my_smarkio_url = 'YOUR SMARK.IO URL HERE';

//The ID of the first lead of the relation
$originId = '359680';

//The ID of the second lead of the relation
$destinyId = '359670';

//Slug of the relation type
$type = 'family';

//Operation of the API, in this case to create a Lead Relation
$operation = 'add';

// create Relation 
$relation = new Relation($originId, $destinyId, $type, $api_token);

// send the request
$response = $relation->send($operation,$my_smarkio_url);

```

## Delete a Lead Relation

```
$api_token = 'YOUR API TOKEN HERE';
$my_smarkio_url = 'YOUR SMARK.IO URL HERE';

//The ID of the first lead of the relation
$originId = '359680';

//The ID of the second lead of the relation
$destinyId = '359670';

//Slug of the relation type
$type = 'family';

//Operation of the API, in this case to delete a Lead Relation
$operation = 'delete';

// create Relation 
$relation = new Relation($originId, $destinyId, $type, $api_token);

// send the request
$response = $relation->send($operation,$my_smarkio_url);
```


