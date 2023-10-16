<?php

namespace App\Services\MathCaptcha;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MathCaptchaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the cptcha service.
     * @return void
     */
    public function register()
    {
        $this->app->singleton('captcha', function ($app) {
            return new MathCaptcha($this->app['session']);
        });
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [MathCaptcha::class];
    }

}
