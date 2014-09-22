<?php
/*
 * An example on how to create a Lead Feedback and how to use the API
 * to send it to LeadOffice.
 */

require __DIR__ . '/../src/Adclick/Smarkio/API/Relation.php';

use Adclick\Smarkio\API\Relation;

$api_token = 'INSERT YOUR TOKEN HERE';

//The ID of the first lead of the relation
$originId = '477173';

//The ID of the second lead of the relation
$destinyId = '477172';

//Slug of the relation type
$type = 'family';

//Operation of the API, in this case to create a Lead Relation
$operation = 'add';

// create Relation
$relation = new Relation($originId, $destinyId, $type, $api_token);

// send the request
$response = $relation->send(null, $operation);

echo "API Response: '{$response}'\n";
