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
 * Categories API
 *
 * @package danaketh\Discourse\API
 * @author  Daniel Tlach <daniel@tlach.cz>
 */
class Category extends AbstractEndpoint
{
    /**
     * List existing categories
     *
     * @return array
     * @throws \danaketh\Discourse\Exception\RequestException
     */
    public function list(): array
    {
        $url = sprintf('%s/categories.json?api_key=%s&api_username=%s', $this->apiHost, $this->apiKey, $this->username);
        $response = Request::get($url);

        return $response['body'];
    }




    /**
     * @param array $data
     *
     * @return array
     * @throws \danaketh\Discourse\Exception\RequestException
     */
    public function create(array $data): array
    {
        $url = sprintf('%s/categories.json?api_key=%s&api_username=%s', $this->apiHost, $this->apiKey, $this->username);
        $response = Request::post($url, $data);

        return $response['body'];
    }
}
