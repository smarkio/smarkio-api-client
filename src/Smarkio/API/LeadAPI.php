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

class LeadAPI
{

    const API_BASE_URL = 'https://smark.io/';
    const API_VERSION  = 'v1';
    const API_PATH     = '/lead/';

    private $client_token = null;


    public function __construct($client_token)
    {
        $this->client_token = $client_token;
    }



    public function getLead($id)
    {
        $client  = new Client();

        $request = $client->get(
            self::API_BASE_URL . self::API_VERSION .
            "/{$this->client_token}/" .
            self::API_PATH . $id)
        ;
        $response = $request->send();
        if($response->getStatusCode() === 200){

        }
        if($response->getStatusCode() !== 404){
            throw new \Exception('Unexpected response - '.$response->getStatusCode().' - '.$response->getBody(true));
        }
        return null;
    }
}