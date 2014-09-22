<?php
/**
 *
 *
 * @author     Vítor Santos <vitor.santos@adclick.pt>
 * @copyright  2014 Adclick
 * @license    [SMARKIO_URL_LICENSE_HERE]
 *
 * [SMARKIO_DISCLAIMER]
 */

namespace Adclick\Smarkio\API;

require_once('SendRelation.php');

class Relation
{

    // Relation fields array
    private $relationFields = array();

    private $api_token = null;

    public function __construct($originId, $destinyId, $type, $api_token = null)
    {

        if (!is_null($api_token))
        {
            $this->setApiToken($api_token);
        }

        $this->setOriginId($originId);
        $this->setDestinyId($destinyId);
        $this->setType($type);
    }

    /**
     * Sets the API access token
     *
     * @param string $api_token
     */
    public function setApiToken($api_token)
    {
        $this->api_token = $api_token;
    }

    /**
     * @return null
     */
    public function getApiToken()
    {
        return $this->api_token;
    }


    /**
     * Returns the origin lead id, if set
     *
     * @return int|string|null The lead id
     */
    public function getOriginId()
    {
        return isset($this->relationFields['origin_id']) ? $this->relationFields['origin_id'] : null;
    }


    /**
     * Sets the origin lead id
     *
     * @param $originId
     */
    public function setOriginId($originId)
    {
        $this->relationFields['origin_id'] = $originId;
    }


    /**
     * Returns the destiny lead id, if set
     *
     * @return int|string|null The Lead id
     */
    public function getDestinyId()
    {
        return isset($this->relationFields['destiny_id']) ? $this->relationFields['destiny_id'] : null;
    }

    /**
     * Sets the destiny lead id
     *
     * @param $destinyId int|string The supplier id
     */
    public function setDestinyId($destinyId)
    {
        $this->relationFields['destiny_id'] = $destinyId;
    }

    /**
     * Returns the relation type slug, if set
     *
     * @return string|null The Lead Relation type slug
     */
    public function getType()
    {
        return isset($this->relationFields['type']) ? $this->relationFields['type'] : null;
    }

    /**
     * Sets the Relation Type slug
     *
     * @param $type string The Lead Relation type slug
     */
    public function setType($type)
    {
        $this->relationFields['type'] = $type;
    }

    /**
     * Returns the lead relation fields to be sent to the API, if set
     *
     * @return array The relation fields
     */
    public function getRelationFields()
    {
        return $this->relationFields;
    }

    /**
     * Sends this lead relation to Smark.io using Smark.io relation API.
     *
     * @param null $api_base_url
     * @param $operation The operation of the API to be performed - Add or Delete
     *
     * @return mixed
     */
    public function send($operation, $api_base_url = null)
    {
        $sendFields =$this->getrelationFields();

        return SendRelation::send($this->api_token, $sendFields, $operation, $api_base_url);
    }
}