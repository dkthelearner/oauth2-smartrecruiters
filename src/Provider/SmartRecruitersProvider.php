<?php

namespace Krdinesh\OAuth2\Client\Provider;

use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\QueryBuilderTrait;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Krdinesh\OAuth2\Client\Provider\SmartRecruitersResourceOwner;

/**
 * Description of SmartRecruitersProvider
 *
 * @author krdinesh
 */
class SmartRecruitersProvider extends AbstractProvider {

    use QueryBuilderTrait;

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

    protected function buildQueryString(array $params) {
        return urldecode(http_build_query($params, null, '&', \PHP_QUERY_RFC3986));
    }

    protected function getScopeSeparator() {
        return ' ';
    }

    //put your code here
    protected function checkResponse(ResponseInterface $response, $data) {
        if(isset($data['error'])) {
            throw new IdentityProviderException($data['error_description'] ?: $response->getReasonPhrase(), $response->getStatusCode(), $response);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token) {
        return new SmartRecruitersResourceOwner($response);
    }

}
