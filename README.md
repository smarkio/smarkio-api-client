#Smark.io API
=========================

An accelerator to communicate with © Smark.io API to manage Lead Relations

Installation and usage with Composer
----------


Add the following to your composer.json file in order to fetch the latest stable version of the project:

```json
{
    "require": {
        "smarkio/smarkio-api-client": "*"
    }
}
```

Then, in order to use the accelerator on your own PHP file, add the following:

```php
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


```php
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

```php
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

## Get a Lead by ID

```php
$api_token = 'YOUR API TOKEN HERE';
$my_smarkio_url = 'YOUR SMARK.IO URL HERE';

// The id of the lead
$my_lead_id = 36;

$lead_api = new \Smarkio\API\LeadAPI($api_token, $my_smarkio_url);
$lead = $lead_api->getLead($my_lead_id);
```

## Search Leads

```php
$api_token = 'YOUR API TOKEN HERE';
$my_smarkio_url = 'YOUR SMARK.IO URL HERE';

$lead_api = new \Smarkio\API\LeadAPI($api_token, $my_smarkio_url);

// Parameters to filter the Search
// If null use defaults
$parameters = array(
    'id_min'               => null, // eg: 123
    'id_max'               => null, // eg: 999
    'creation_date_min'    => null, // eg: '2015-07-01'
    'creation_date_max'    => null, // eg: '2015-07-31'
    'integration_date_min' => null, // eg: '2015-07-01'
    'integration_date_max' => null, // eg: '2015-07-31'
    'limit'                => null, // eg: 100
    'offset'               => null  // eg: 0
)

// Get the paginated results
$paginated_leads = $lead_api->searchLead($parameters);
$continue_processing = true;

// Get all the pages
while ($continue_processing) {
    $leads = $paginated_leads->getLeads();

    // Do something with the leads ...

    $continue_processing = $paginated_leads->hasNext();
    if ( $continue_processing ) {
        // Get the next results
        $paginated_leads = $paginated_leads->next();
    }
}
```
