<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Cloudflare;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use Upmind\ProvisionBase\Provider\Contract\ProviderInterface;
use Upmind\ProvisionBase\Provider\DataSet\AboutData;
use Upmind\ProvisionProviders\SharedHosting\Category;
use Upmind\ProvisionProviders\SharedHosting\Data\CreateParams;
use Upmind\ProvisionProviders\SharedHosting\Data\AccountInfo;
use Upmind\ProvisionProviders\SharedHosting\Data\AccountUsage;
use Upmind\ProvisionProviders\SharedHosting\Data\AccountUsername;
use Upmind\ProvisionProviders\SharedHosting\Data\ChangePackageParams;
use Upmind\ProvisionProviders\SharedHosting\Data\ChangePasswordParams;
use Upmind\ProvisionProviders\SharedHosting\Data\EmptyResult;
use Upmind\ProvisionProviders\SharedHosting\Data\GetLoginUrlParams;
use Upmind\ProvisionProviders\SharedHosting\Data\GrantResellerParams;
use Upmind\ProvisionProviders\SharedHosting\Data\LoginUrl;
use Upmind\ProvisionProviders\SharedHosting\Data\ResellerPrivileges;
use Upmind\ProvisionProviders\SharedHosting\Data\SuspendParams;
use Upmind\ProvisionProviders\SharedHosting\Cloudflare\Data\Configuration;

/**
 * Cloudflare hosting provider template.
 */
class Provider extends Category implements ProviderInterface
{
    protected Configuration $configuration;
    protected Client $client;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @inheritDoc
     */
    public static function aboutProvider(): AboutData
    {
        return AboutData::create()
            ->setName('Cloudflare')
            ->setDescription('Create and manage Cloudflare Edge SSL(s). Contributed by PodPress.io')
            ->setLogoUrl('https://upload.wikimedia.org/wikipedia/commons/4/4b/Cloudflare_Logo.svg');
    }

    /**
     * @inheritDoc
     */
    public function create(CreateParams $params): AccountInfo
    {
        $parts =  [
            $this->configuration->cloudflare,
            $this->configuration->version,
            $this->configuration->base,
            $this->configuration->zone,
            $this->configuration->endpoint
        ];
        
        $apiUrl = implode('/', $parts);
    
        $client = new Client([
            'handler' => $this->getGuzzleHandlerStack(
                boolval($this->configuration->debug)
            ),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer WcZoC8Rg5LjJeMmvUjMIoidBfCDamCAopZZLzWJ8',
            ],
        ]);
        
        $response = $client->request('POST', $apiUrl, [
            RequestOptions::JSON => [
                'hostname' => $params->domain,
                'custom_origin_server' => 'testtest.io',
                "ssl" => [
                    "bundle_method" => $this->configuration->bundle_method,
                    "certificate_authority" => $this->configuration->certificate_authority,
                    "method" => $this->configuration->method,
                    "type" => "dv"
                ],
                "settings" => [
                    "early_hints" => $this->configuration->early_hints,
                    "http2" => $this->configuration->http2,
                    "min_tls_version" => $this->configuration->min_tls_version,
                    "tls_1_3" => $this->configuration->tls_1_3,
                ]
            ],
        ]);
        
        return $this->getInfo(AccountUsername::create([
            'username' => $params->username,
            'domain' => $params->domain,
            'package_name' => $params->package_name,
        ]))->setMessage('Account created');
    }

    /**
     * @inheritDoc
     */
    public function getInfo(AccountUsername $params): AccountInfo
    {
        return AccountInfo::create()
            ->setDomain($params->domain)
            ->setUsername($params->domain)
            ->setServerHostname($params->domain)
            ->setPackageName($params->package_name)
            ->setReseller(false)
            ->setSuspended(false);
    }

    public function getUsage(AccountUsername $params): AccountUsage
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getLoginUrl(GetLoginUrlParams $params): LoginUrl
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function changePassword(ChangePasswordParams $params): EmptyResult
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function changePackage(ChangePackageParams $params): AccountInfo
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function suspend(SuspendParams $params): AccountInfo
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function unSuspend(AccountUsername $params): AccountInfo
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function terminate(AccountUsername $params): EmptyResult
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function grantReseller(GrantResellerParams $params): ResellerPrivileges
    {
        throw $this->errorResult('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function revokeReseller(AccountUsername $params): ResellerPrivileges
    {
        throw $this->errorResult('Not implemented');
    }
}
