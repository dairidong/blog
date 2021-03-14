<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class ESServiceProvider
 * @package App\Providers
 */
class ESServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('scout.elasticsearch.hosts'))
                ->build();
        });

        $this->app->alias(Client::class, 'elasticsearch');
        $this->app->alias(Client::class, 'es');
    }

    public function provides()
    {
        return [Client::class];
    }
}
