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

$paginated_leads = $lead_api->searchLead();
$leads_first_page = $paginated_leads->getLeads();

if($paginated_leads->hasNext())
{
    $second_page       = $paginated_leads->next();
    $leads_second_page = $second_page->getLeads();
}