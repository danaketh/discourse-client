<?php

/*
 * This file is part of the Discourse API Client.
 *
 * (c) danaketh, s.r.o. <dev@danaketh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace danaketh\Discourse;

use danaketh\Discourse\API\Category;
use danaketh\Discourse\API\Post;
use danaketh\Discourse\API\User;



/**
 * Discourse API client
 *
 * @package danaketh\Discourse
 * @author  Daniel Tlach <daniel@tlach.cz>
 */
class Discourse
{

    /** @var Category $category */
    protected $category;

    /** @var User $user */
    protected $user;

    /** @var Post $post */
    protected $post;

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




    /**
     * Provides access to the Blog API
     *
     * @return Category
     */
    public function category(): Category
    {
        if (!$this->category) {
            $this->category = new Category($this->apiKey, $this->apiHost, $this->username);
        }

        return $this->category;
    }




    /**
     * @return User
     */
    public function user(): User
    {
        if (!$this->user) {
            $this->user = new User($this->apiKey, $this->apiHost, $this->username);
        }

        return $this->user;
    }




    /**
     * @return Post
     */
    public function post(): Post
    {
        if (!$this->post) {
            $this->post = new Post($this->apiKey, $this->apiHost, $this->username);
        }

        return $this->post;
    }
}
