<?php

namespace AmoCRM\Core\Facades;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Core\ManageAccessToken\AccessTokenManagerInterface;
use AmoCRM\OAuth\OAuthServiceInterface;
use AmoCRM\Auth\AuthManagerInterface;
use AmoCRM\Core\Manager\AmoManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AmoManager domain(string $domain)
 * @method static AmoCRMApiClient api()
 * @method static OAuthServiceInterface oauth()
 * @method static AccessTokenManagerInterface tokenizer()
 *
 * @see AmoManager
 * @mixin AuthManagerInterface
 */
class Amo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'amocrm';
    }
}