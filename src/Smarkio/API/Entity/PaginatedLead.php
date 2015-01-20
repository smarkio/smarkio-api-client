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

namespace Smarkio\API\Entity;


use Smarkio\API\LeadAPI;

class PaginatedLead
{

    /**
     * @var Lead[]
     */
    private $leads;

    /**
     * @var string
     */
    private $next_token;

    /**
     * @var LeadAPI
     */
    private $leadAPI;

    /**
     * @param Lead[]  $leads
     * @param string  $next_token
     * @param LeadAPI $leadAPI
     */
    function __construct(array $leads, $next_token, LeadAPI $leadAPI)
    {
        $this->leadAPI    = $leadAPI;
        $this->leads      = $leads;
        $this->next_token = $next_token;
    }

    function __invoke()
    {
        return $this->getLeads();
    }

    /**
     * @return Lead[]
     */
    public function getLeads()
    {
        return $this->leads;
    }

    /**
     * Retrieves and return nextPage
     *
     * @return PaginatedLead
     * @throws \Exception
     * @throws \Smarkio\API\Exception\ExpiredNextPageTokenException
     * @throws \Smarkio\API\Exception\InvalidNextPageTokenException
     */
    public function next()
    {
        if ($this->hasNext())
        {
            return $this->leadAPI->searchLead(array('next_page_token' => $this->next_token));
        }
    }

    /**
     * Has next page
     *
     * @return bool
     */
    public function hasNext()
    {
        return !is_null($this->next_token);
    }
}