<?php

namespace AmoCRM\Core\Manager;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Core\ManageAccessToken\AccessTokenManager;
use AmoCRM\OAuth\OAuthServiceInterface;
use AmoCRM\Auth\AuthManagerInterface;
use AmoCRM\Core\ManageAccessToken\AccessTokenManagerInterface;

interface AmoManagerInterface
{
    public function api(): AmoCRMApiClient;

    public function authenticator(): AuthManagerInterface;

    public function oauth(): OAuthServiceInterface;

    public function tokenizer(): AccessTokenManagerInterface;

    public function domain(string $domain): AmoManagerInterface;

}