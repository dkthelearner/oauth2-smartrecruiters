<?php

namespace Krdinesh\OAuth2\Client\Provider;

use League\OAuth2\Client\Tool\ArrayAccessorTrait;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartRecruitersResourceOwner
 * @author krdinesh
 */
class SmartRecruitersResourceOwner implements ResourceOwnerInterface {

    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array()) {
        $this->response = $response;
    }

    /**
     * Get ID
     * @return type
     */
    public function getId() {
        return $this->getValueByKey($this->response, 'id');
    }

    /**
     * Get user email
     *
     * @return string|null
     */
    public function getEmail() {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * Get user First name
     *
     * @return string|null
     */
    public function getFirstName() {
        return $this->getValueByKey($this->response, 'firstName');
    }

    /**
     * Get user Last name
     *
     * @return string|null
     */
    public function getLastName() {
        return $this->getValueByKey($this->response, 'lastName');
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray() {
        return $this->response;
    }

}
