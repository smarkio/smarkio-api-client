<?php

namespace Smarkio\API;

class SendRelation
{

    const API_BASE_URL = 'https://smark.io/';
    const API_VERSION = 'v1';

    public static function send($api_token, $post_fields, $operation, $api_url = null)
    {
        $base_api_url = self::API_BASE_URL;
        if (!is_null($api_url))
        {
            $base_api_url = self::fix_url($api_url);
        }

        $api_token = urlencode($api_token);
        $url = "{$base_api_url}api.php/" . self::API_VERSION . "/{$api_token}/relation/"."{$operation}/";

        /* eg: https://smark.io/api.php/v1/XPTO000123/relation/add/ */
        /* eg: https://smark.io/api.php/v1/XPTO000123/relation/delete/ */

        $rtn = self::adc_curl_post($url, $post_fields);

        return $rtn;
    }

    private static function adc_curl_post($url, $post_fields)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_handle, CURLOPT_HEADER, 0);
        curl_setopt($curl_handle, CURLOPT_FAILONERROR, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($post_fields));
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT_MS, 15000);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT_MS, 15000);

        $result = curl_exec($curl_handle);

        curl_close($curl_handle);

        return $result;
    }

    private static function fix_url($url)
    {
        $arr_url = parse_url($url);

        if (!isset($arr_url['scheme']))
        {
            $arr_url['scheme'] = 'http';
        }
        if (!isset($arr_url['host']))
        {
            $arr_url['host'] = '';
        }
        if (!isset($arr_url['path']))
        {
            $arr_url['path'] = '/';
        }

        if ('/' != substr($arr_url['path'], -1, 1))
        {
            $arr_url['path'] = $arr_url['path'] . "/";
        }

        $ret = $arr_url['scheme'] . "://" . $arr_url['host'] . $arr_url['path'];

        if (isset($arr_url['query']))
        {
            $ret .= "?{$arr_url['query']}";
        }

        if (isset($arr_url['fragment']))
        {
            $ret .= "#{$arr_url['fragment']}";
        }

        return $ret;
    }
}