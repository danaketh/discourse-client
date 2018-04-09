<?php

/*
 * This file is part of the Discourse API Client.
 *
 * (c) danaketh, s.r.o. <dev@danaketh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace danaketh\Discourse\API;

/**
 * Class AbstractEndpoint
 *
 * @package danaketh\Discourse\API
 * @author  Daniel Tlach <daniel@tlach.cz>
 */
abstract class AbstractEndpoint
{
    /**
     * @var string $apiKey API key storage
     */
    protected $apiKey;

    /**
     * @var string $apiHost Base API URL
     */
    protected $apiHost;

    /** @var string $username */
    protected $username;




    /**
     * @param string $apiKey
     * @param string $apiHost
     * @param        $username
     */
    public function __construct($apiKey, $apiHost, $username)
    {
        $this->apiKey = $apiKey;
        $this->apiHost = $apiHost;
        $this->username = $username;
    }
}
