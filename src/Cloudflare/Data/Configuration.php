<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Cloudflare\Data;

use Upmind\ProvisionBase\Provider\DataSet\DataSet;
use Upmind\ProvisionBase\Provider\DataSet\Rules;

/**
 * Cloudflare API credentials.
 *
 * @property-read string $cloudflare Cloudflare account' unique endpoint - only!
 * @property-read string $zone Cloudflare global API token - or specific key!
 * @property-read string $version Cloudflare global API token - or specific key!
 * @property-read string $base Cloudflare global API token - or specific key!
 * @property-read string $endpoint Cloudflare global API token - or specific key!
 * @property-read string $bearer Cloudflare global API token - or specific key!
 * @property-read string $bundle_method Cloudflare global API token - or specific key!
 * @property-read string $certificate_authority Cloudflare global API token - or specific key!
 * @property-read string $method Cloudflare global API token - or specific key!
 * @property-read string $http2 Cloudflare global API token - or specific key!
 * @property-read string $early_hints Cloudflare global API token - or specific key!
 * @property-read string $min_tls_version Cloudflare global API token - or specific key!
 * @property-read string $tls_1_3 Cloudflare global API token - or specific key!
 * @property-read bool $debug To debug, or not to debug - that's the question!
 */
class Configuration extends DataSet
{
    public static function rules(): Rules
    {
        return new Rules([
            'cloudflare' => ['required', 'string'],
            'zone' => ['required', 'string'],
            'version' => ['required', 'string'],
            'base' => ['required', 'string'],
            'endpoint' => ['required', 'string'],
            'bearer' => ['required', 'string'],
            'bundle_method' => ['required', 'string'],
            'certificate_authority' => ['required', 'string'],
            'method' => ['required', 'string'],
            'http2' => ['required', 'string'],
            'early_hints' => ['required', 'string'],
            'min_tls_version' => ['required', 'string'],
            'tls_1_3' => ['required', 'string'],
            'debug' => ['boolean'],
        ]);
    }
}
