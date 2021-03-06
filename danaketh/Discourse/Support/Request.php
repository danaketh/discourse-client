<?php

/*
 * This file is part of the Discourse API Client.
 *
 * (c) danaketh, s.r.o. <dev@danaketh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace danaketh\Discourse\Support;

use danaketh\Discourse\Exception\RequestException;



/**
 * cURL wrapper
 *
 * @package danaketh\Discourse\Support
 * @author  Daniel Tlach <daniel@tlach.cz>
 */
class Request
{
    /** @var boolean $flagVerifySSL Should NEVER be set FALSE in production */
    protected static $flagVerifySSL = true;




    /**
     * @param string $url
     *
     * @return array
     * @throws RequestException
     */
    public static function get($url): array
    {
        $instance = curl_init($url);
        curl_setopt_array($instance, [
            CURLOPT_RETURNTRANSFER => true,
        ]);
        self::disableSSL($instance);
        $request = curl_exec($instance);

        if (!$request) {
            throw new RequestException(curl_error($instance));
        }

        return self::response($request, $instance);
    }




    /**
     * @param string $url
     * @param array  $data
     *
     * @return array
     * @throws RequestException
     */
    public static function post($url, $data): array
    {
        $instance = curl_init($url);
        curl_setopt_array($instance, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $data
        ]);
        self::disableSSL($instance);
        $request = curl_exec($instance);

        if (!$request) {
            throw new RequestException(curl_error($instance));
        }

        return self::response($request, $instance);
    }




    /**
     * @param string $url
     * @param array  $data
     *
     * @return array
     * @throws RequestException
     */
    public static function put($url, $data): array
    {
        $instance = curl_init($url);
        curl_setopt_array($instance, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_POSTFIELDS     => $data
        ]);
        self::disableSSL($instance);
        $request = curl_exec($instance);

        if (!$request) {
            throw new RequestException(curl_error($instance));
        }

        return self::response($request, $instance);
    }




    /**
     * @param string $url
     *
     * @return array
     * @throws RequestException
     */
    public static function delete($url): array
    {
        $instance = curl_init($url);
        curl_setopt_array($instance, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'DELETE'
        ]);
        self::disableSSL($instance);
        $request = curl_exec($instance);

        if (!$request) {
            throw new RequestException(curl_error($instance));
        }

        return self::response($request, $instance);
    }




    /**
     * @param string $url
     * @param array  $data
     *
     * @return array
     * @throws RequestException
     */
    public static function patch($url, $data): array
    {
        $instance = curl_init($url);
        curl_setopt_array($instance, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'PATCH',
            CURLOPT_POSTFIELDS     => $data,
        ]);
        self::disableSSL($instance);
        $request = curl_exec($instance);

        if (!$request) {
            throw new RequestException(curl_error($instance));
        }

        return self::response($request, $instance);
    }




    /**
     * Triggers the SSL verification. This is inteded ONLY for development purposes
     * you should NEVER use this in production code!
     *
     * @param boolean $flag
     */
    public static function setSSLVerification($flag)
    {
        self::$flagVerifySSL = $flag;
    }




    /**
     * Disables the SSL verification for cURL. This is inteded ONLY for development purposes
     * you should NEVER use this in production code!
     *
     * @param resource $instance
     */
    protected static function disableSSL($instance)
    {
        if (self::$flagVerifySSL === false) {
            curl_setopt($instance, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($instance, CURLOPT_SSL_VERIFYHOST, false);
        }
    }




    /**
     * @param resource $request
     * @param resource $instance
     *
     * @return array
     */
    protected static function response($request, $instance): array
    {
        $info = curl_getinfo($instance);
        curl_close($instance);

        return [
            'code'         => $info['http_code'],
            'body'         => strpos($info['content_type'], 'application/json') !== false
                ? json_decode($request, JSON_OBJECT_AS_ARRAY)
                : $request,
            'content-type' => $info['content_type'],
        ];
    }
}
