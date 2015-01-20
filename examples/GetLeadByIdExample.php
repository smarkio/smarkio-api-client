<?php
/**
 * 
 *
 * @author     Pedro Borges <pedro.borges@adclick.pt>
 * @copyright  2015 Adclick
 *
 */

require __DIR__. '/../src/Smarkio/API/LeadAPI.php';
require __DIR__. '/../lib/vendor/autoload.php';

$lead_api = new \Smarkio\API\LeadAPI('smarkio_user_token', 'http://smarkio.dev/');
$lead = $lead_api->getLead(36);
echo 'Lead id'.$lead->lead_id;

