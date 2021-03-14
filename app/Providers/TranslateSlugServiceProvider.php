<?php

namespace App\Providers;

use App\Services\TranslateSlug;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * slug 翻译服务（延时模式）
 * Class TranslateSlugServiceProvider
 * @package App\Providers
 */
class TranslateSlugServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TranslateSlug::class, function ($app) {
            return new TranslateSlug(config('baidu_trans.appKey'), config('baidu_trans.appSecret'));
        });

        $this->app->alias(TranslateSlug::class, 'translate-slug');
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [TranslateSlug::class];
    }
}
