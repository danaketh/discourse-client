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

use danaketh\Discourse\Support\Request;



/**
 * Post API
 *
 * @package danaketh\Discourse\API
 * @author  Daniel Tlach <daniel@tlach.cz>
 */
class Post extends AbstractEndpoint
{
    /**
     * @param string $username
     * @param array  $data
     *
     * @return array
     * @throws \danaketh\Discourse\Exception\RequestException
     */
    public function create($username, array $data): array
    {
        $url = sprintf('%s/posts', $this->apiHost);
        $data['api_key'] = $this->apiKey;
        $data['api_username'] = $username;
        $response = Request::post($url, $data);

        return $response['body'];
    }/**
     * @param string $username
     * @param array  $data
     *
     * @return array
     * @throws \danaketh\Discourse\Exception\RequestException
     */
    public function getTopic($id): array
    {
        $url = sprintf('%s/t/%s.json?api_key=%s&api_username=%s', $this->apiHost, $id, $this->apiKey, $this->username);
        $response = Request::get($url);

        return $response['body'];
    }
}
