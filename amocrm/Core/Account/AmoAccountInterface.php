<?php

namespace AmoCRM\Core\Account;

use League\OAuth2\Client\Token\AccessToken;

/**
 * @property int $id
 * @property string $domain
 */
interface AmoAccountInterface
{
    public static function getByDomain(string $domain): ?AmoAccountInterface;

    public function getAccessToken(): AccessToken;

    public function getDomain(): string;

    public function getId(): int;
}