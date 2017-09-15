<?php

namespace Krdinesh\OAuth2\Client\Provider;


use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Krdinesh\OAuth2\Client\Provider\SmartRecruitersResourceOwner;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartRecruitersProvider
 *
 * @author krdinesh
 */
class SmartRecruitersProvider extends AbstractProvider {

    protected function createResourceOwner(array $response, AccessToken $token) {
        return new SmartRecruitersResourceOwner($response);
    }

    protected function getScopeSeparator() {
        return ' ';
    }

    protected function getDefaultScopes() {
        return ['candidates_create', 'jobs_read', 'candidates_read'];
    }

    public function getBaseAccessTokenUrl(array $params) {
        return "https://www.smartrecruiters.com/identity/oauth/token";
    }

    public function getBaseAuthorizationUrl() {
        return "https://www.smartrecruiters.com/identity/oauth/allow";
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token) {
        return "https://api.smartrecruiters.com/users/me";
    }

    //put your code here
    protected function checkResponse(ResponseInterface $response, $data) {
        if(isset($data['error'])) {
            throw new IdentityProviderException($data['error_description'] ?: $response->getReasonPhrase(), $response->getStatusCode(), $response);
        }
    }

}
