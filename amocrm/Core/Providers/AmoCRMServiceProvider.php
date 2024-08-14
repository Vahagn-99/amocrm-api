<?php

namespace AmoCRM\Core\Providers;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiClientFactory;
use AmoCRM\Core\ManageAccessToken\AccessTokenManager;
use AmoCRM\Core\ManageAccessToken\AccessTokenManagerInterface;
use AmoCRM\OAuth\OAuthConfigInterface;
use AmoCRM\OAuth\OAuthServiceInterface;
use AmoCRM\Auth\AmoCrmAuthManager;
use AmoCRM\Auth\AuthManagerInterface;
use AmoCRM\Core\Manager\AmoManager;
use AmoCRM\Core\Manager\AmoManagerInterface;
use AmoCRM\Core\Oauth\OauthConfig;
use AmoCRM\Core\Oauth\OauthService;
use AmoCRM\Entities\Contact\ContactApi;
use AmoCRM\Entities\Contact\ContactApiInterface;
use AmoCRM\Entities\Lead\LeadApi;
use AmoCRM\Entities\Lead\LeadApiInterface;
use AmoCRM\Entities\Source\SourceApi;
use AmoCRM\Entities\Source\SourceApiInterface;
use AmoCRM\Entities\User\UserApi;
use AmoCRM\Entities\User\UserApiInterface;
use AmoCRM\Entities\Webhook\SubscriberInterface;
use AmoCRM\Entities\Webhook\WebhookSubscriberApi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AmoCRMServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OAuthConfigInterface::class, function () {
            return new OAuthConfig(config('services.amocrm.client_id'), config('services.amocrm.client_secret'), config('services.amocrm.redirect_url'));
        });
        $this->app->bind(OAuthServiceInterface::class, OauthService::class);
        $this->app->bind(AmoCRMApiClient::class, function () {
            /** @var AmoCRMApiClientFactory $factory */
            $factory = app(AmoCRMApiClientFactory::class);

            return $factory->make();
        });
        $this->app->bind(AmoManagerInterface::class, AmoManager::class);
        $this->app->bind(AuthManagerInterface::class, AmoCrmAuthManager::class);
        $this->app->bind('amocrm', AmoManagerInterface::class);
        $this->app->bind(AccessTokenManagerInterface::class, function () {
            return new AccessTokenManager(Storage::disk("amocrm"));
        });

        //entity api client bindings
        $this->app->bind(SubscriberInterface::class, WebhookSubscriberApi::class);
        $this->app->bind(UserApiInterface::class, UserApi::class);
        $this->app->bind(ContactApiInterface::class, ContactApi::class);
        $this->app->bind(LeadApiInterface::class, LeadApi::class);
        $this->app->bind(SourceApiInterface::class, SourceApi::class);

        // aliases
        $this->app->alias("my-widget-name", AmoCRMApiClient::class);
    }
}
