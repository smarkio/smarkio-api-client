<?php
/**
 *
 *
 * @author     Pedro Borges <pedro.borges@adclick.pt>
 * @copyright  2015 Adclick
 * @license    [SMARKIO_URL_LICENSE_HERE]
 *
 * [SMARKIO_DISCLAIMER]
 */

namespace Smarkio\API;


use Guzzle\Http\Client;
use Smarkio\API\Entity\Lead;
use Smarkio\API\Entity\PaginatedLead;
use Smarkio\API\Exception\ExpiredNextPageTokenException;
use Smarkio\API\Exception\InvalidNextPageTokenException;

class LeadAPI
{

    const API_BASE_URL = 'https://smark.io/';
    const API_VERSION  = 'v1';
    const API_PATH     = '/lead/';

    private $api_base_url;

    private $client_token = null;


    public function __construct($client_token, $api_base_url = self::API_BASE_URL)
    {
        $this->client_token = $client_token;
        $this->api_base_url = $api_base_url;
    }


    /**
     * Retrieves a lead by ID.
     *
     * Returns Lead if found, null if not found.
     * Throw exception if an unexpected message is received.
     *
     *
     * @param $id
     *
     * @return null|Lead
     * @throws \Exception
     */
    public function getLead($id)
    {
        $client = new Client();

        $request  = $client->get(
            $this->api_base_url . 'api.php/' . self::API_VERSION .
            "/{$this->client_token}" .
            self::API_PATH . $id)
        ;
        $response = $request->send();
        if ($response->getStatusCode() === 200)
        {
            $result = json_decode($response->getBody(true), true);
            if ($result)
            {
                return new Lead($result['lead']);
            }
        }
        if ($response->getStatusCode() === 404)
        {
            return null;
        }
        throw new \Exception('Unexpected response - ' . $response->getStatusCode() . ' - ' . $response->getBody(true));
    }


    /**
     * @param array $parameters Query parameters.
     *
     *                          id_min: integer
     *                          id_max: integer
     *                          creation_date_min: date (YYYY-MM-DD)
     *                          creation_date_max: date (YYYY-MM-DD)
     *                          integration_date_min: date (YYYY-MM-DD)
     *                          integration_date_max: date (YYYY-MM-DD)
     *                          limit: date (YYYY-MM-DD)
     *                          next_page_token: string
     *
     * @return PaginatedLead
     * @throws ExpiredNextPageTokenException if next_page_token its past its lifespan
     * @throws InvalidNextPageTokenException if next_page_token is invalid
     * @throws \Exception
     */
    public function searchLead(array $parameters = array())
    {
        $defaults   = array(
            'id_min'               => null,
            'id_max'               => null,
            'creation_date_min'    => null,
            'creation_date_max'    => null,
            'integration_date_min' => null,
            'integration_date_max' => null,
            'limit'                => null,
            'offset'               => null,
            'next_page_token'      => null,
        );
        $parameters = array_intersect_key($parameters, $defaults);
        $client     = new Client();
        $request    = $client->get(
            $this->api_base_url . 'api.php/' . self::API_VERSION .
            "/{$this->client_token}" .
            self::API_PATH, array(),array( 'query' => $parameters))
        ;
        $response = $request->send();
        if ($response->getStatusCode() === 200)
        {
            $result = json_decode($response->getBody(true), true);
            if ($result)
            {
                $leads = array();
                foreach($result['leads'] as $lead){
                    $leads[] = new Lead($lead);
                }
                return new PaginatedLead($leads,isset($result['next_page_token'])?$result['next_page_token']:null,$this);
            }
        }
        if ($response->getStatusCode() === 410)
        {
            throw new ExpiredNextPageTokenException('Expired Token',410);
        }
        if ($response->getStatusCode() === 406)
        {
            throw new InvalidNextPageTokenException('Invalid Token',406);
        }
        throw new \Exception('Unexpected response - ' . $response->getStatusCode() . ' - ' . $response->getBody(true));
    }
}