<?php

declare(strict_types=1);

namespace AmoCRM\Core\Oauth;

use AmoCRM\Core\ManageAccessToken\AccessTokenManagerInterface;
use AmoCRM\OAuth\OAuthServiceInterface;
use League\OAuth2\Client\Token\AccessTokenInterface;

readonly class OauthService implements OAuthServiceInterface
{
    public function __construct(private AccessTokenManagerInterface $accessTokenManager)
    {
    }

    public function saveOAuthToken(AccessTokenInterface $accessToken, string $baseDomain): void
    {
        $this->accessTokenManager->saveAccessToken($accessToken);
    }
}
