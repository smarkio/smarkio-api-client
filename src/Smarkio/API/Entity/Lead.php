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

/**
 * Class Lead
 * @package Smarkio\API\Entity
 * @property
 *
 * @property int lead_id
 * @property string lead_fist_name
 * @property string lead_last_name
 * @property int lead_integration_status_id
 * @property string lead_integration_status
 * @property string lead_status
 * @property string lead_integration_at
 * @property string lead_integration_reason
 * @property string lead_integration_reason_description
 * @property string lead_closed_at
 * @property string lead_contacted_at
 * @property string lead_birthdate
 * @property string lead_address
 * @property string lead_zip_code
 * @property string lead_city
 * @property string lead_email
 * @property string lead_phone
 * @property string lead_identification_number_1
 * @property string lead_identification_number_2
 * @property string lead_gender
 * @property string lead_age
 * @property string age_group_from
 * @property string age_group_to
 * @property string campaign_name
 * @property string website_id
 * @property string website_name
 * @property string website_url
 * @property string website_created_at
 * @property string website_updated_at
 * @property string lead_url
 * @property array  additional_attributes
 * @property string lead_creation_at
 */
class Lead
{

    private $_data;

    const INT_TYPE      = 0;
    const STRING_TYPE   = 1;
    const ARRAY_TYPE    = 2;
    const DATETIME_TYPE = 3;
    const DATE_TYPE     = 4;

    private static $_valid_keys = array(
        'lead_id'                             => self::INT_TYPE,
        'lead_fist_name'                      => self::STRING_TYPE,
        'lead_last_name'                      => self::STRING_TYPE,
        'lead_integration_status_id'          => self::INT_TYPE,
        'lead_integration_status'             => self::STRING_TYPE,
        'lead_status'                         => self::STRING_TYPE,
        'lead_creation_at'                    => self::DATETIME_TYPE,
        'lead_integration_at'                 => self::DATETIME_TYPE,
        'lead_integration_reason'             => self::STRING_TYPE,
        'lead_integration_reason_description' => self::STRING_TYPE,
        'lead_closed_at'                      => self::DATETIME_TYPE,
        'lead_contacted_at'                   => self::DATETIME_TYPE,
        'lead_birthdate'                      => self::DATE_TYPE,
        'lead_address'                        => self::STRING_TYPE,
        'lead_zip_code'                       => self::STRING_TYPE,
        'lead_city'                           => self::STRING_TYPE,
        'lead_email'                          => self::STRING_TYPE,
        'lead_phone'                          => self::STRING_TYPE,
        'lead_identification_number_1'        => self::STRING_TYPE,
        'lead_identification_number_2'        => self::STRING_TYPE,
        'lead_gender'                         => self::STRING_TYPE,
        'lead_age'                            => self::INT_TYPE,
        'age_group_from'                      => self::INT_TYPE,
        'age_group_to'                        => self::INT_TYPE,
        'campaign_name'                       => self::STRING_TYPE,
        'website_id'                          => self::INT_TYPE,
        'website_name'                        => self::STRING_TYPE,
        'website_url'                         => self::STRING_TYPE,
        'website_created_at'                  => self::DATETIME_TYPE,
        'website_updated_at'                  => self::DATETIME_TYPE,
        'lead_url'                            => self::STRING_TYPE,
    );

    function __construct(array $values)
    {
        foreach ($values as $name => $value)
        {
            $this->__set($name, $value);
        }
    }


    function __get($name)
    {
        if (array_key_exists($name, $this->_data))
        {
            return $this->_data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);

        return null;
    }

    function __set($name, $value)
    {
        $type = isset(self::$_valid_keys[$name])?self::$_valid_keys[$name]:null;
        switch($type){
            case self::INT_TYPE:

                $value = is_numeric($value)?intval($value):null;
                break;
            case self::STRING_TYPE:
                break;
            case self::ARRAY_TYPE:
                break;
            case self::DATETIME_TYPE:
                $value = \DateTime::createFromFormat('Y-m-d H:i:s',$value);
                break;
            case self::DATE_TYPE:
                $value = \DateTime::createFromFormat('Y-m-d',$value);
                break;
            default:
                return;
        }
        $this->_data[$name] = $value;
    }

    function __isset($name)
    {
        return isset($this->_data[$name]);
    }
}