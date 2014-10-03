<?php
/*
 * An example on how to delete a Lead Relation on Smark.io
 */

require __DIR__ . '/../src/Smarkio/API/Relation.php';

use Smarkio\API\Relation;

$api_token = 'INSERT YOUR TOKEN HERE';
$my_smarkio_url = 'INSERT YOUR SMARK.IO URL HERE';

//The ID of the first lead of the relation
$originId = '477173';

//The ID of the second lead of the relation
$destinyId = '477172';

//Slug of the relation type
$type = 'family';

//Operation of the API, in this case to delete a Lead Relation
$operation = 'delete';

// create Relation
$relation = new Relation($originId, $destinyId, $type, $api_token);

// send the request
$response = $relation->send($operation,$my_smarkio_url);

echo "API Response: '{$response}'\n";
