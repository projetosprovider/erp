<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        Horizon::routeMailNotificationsTo('cesar.sousa@provider-es.com.br');
        Horizon::routeSlackNotificationsTo('https://hooks.slack.com/services/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', '#notificações');

        //Horizon::night();
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewHorizon', function ($user) {
            return in_array($user->email, [
                'cesar.sousa@provider-es.com.br'
            ]);
        });
    }
}
