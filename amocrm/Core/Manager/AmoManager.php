<?php

namespace AmoCRM\Core\Manager;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Core\ManageAccessToken\AccessTokenManager;
use AmoCRM\OAuth\OAuthServiceInterface;
use AmoCRM\Auth\AuthManagerInterface;
use AmoCRM\Core\ManageAccessToken\AccessTokenManagerInterface;
use App\Models\User;

readonly class AmoManager implements AmoManagerInterface
{
    public function __construct(
        private AmoCRMApiClient $apiClient,
        private AuthManagerInterface $authManager,
        private OAuthServiceInterface $authService,
        private AccessTokenManagerInterface $tokenManager,

    ) {
    }

    public function api(): AmoCRMApiClient
    {
        return $this->apiClient;
    }

    public function authenticator(): AuthManagerInterface
    {
        return $this->authManager;
    }

    public function oauth(): OAuthServiceInterface
    {
        return $this->authService;
    }

    public function tokenizer(): AccessTokenManagerInterface
    {
        return $this->tokenManager;
    }

    public function domain(string $domain): AmoManagerInterface
    {
        /** @var  AmoCRMApiClient $client */
        $client = app(AmoCRMApiClient::class);
        $client->setAccountBaseDomain($domain);

        if (method_exists(User::class, 'getByDomain')) {
            $user = User::getByDomain($domain);
            $client->setAccessToken($user->getAccessToken());
        } else {
            $client->setAccessToken(static::tokenizer()->getAccessToken());
        }

        return $this;
    }
}