<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting;

use Upmind\ProvisionBase\Laravel\ProvisionServiceProvider;
use Upmind\ProvisionProviders\SharedHosting\Category as SharedHosting;
use Upmind\ProvisionProviders\SharedHosting\Cloudflare\Provider as Cloudflare;
use Upmind\ProvisionProviders\SharedHosting\Demo\Provider as Demo;
use Upmind\ProvisionProviders\SharedHosting\WHMv1\Provider as WHMv1;
use Upmind\ProvisionProviders\SharedHosting\PleskOnyxRPC\Provider as PleskOnyxRPC;
use Upmind\ProvisionProviders\SharedHosting\TwentyI\Provider as TwentyI;
use Upmind\ProvisionProviders\SharedHosting\Enhance\Provider as Enhance;

class LaravelServiceProvider extends ProvisionServiceProvider
{
    public function boot()
    {
        $this->bindCategory('shared-hosting', SharedHosting::class);

        $this->bindProvider('shared-hosting', 'demo', Demo::class);
        $this->bindProvider('shared-hosting', 'cpanel', WHMv1::class);
        $this->bindProvider('shared-hosting', 'plesk-onyx', PleskOnyxRPC::class);
        $this->bindProvider('shared-hosting', '20i', TwentyI::class);
        $this->bindProvider('shared-hosting', 'enhance', Enhance::class);
        $this->bindProvider('shared-hosting', 'cloudflare', Cloudflare::class);
    }
}
