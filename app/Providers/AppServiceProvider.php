<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WebsiteInformationService::class, function ($app) {
            // return new WebsiteInformationService();
        });

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->composeViews();

        Fortify::loginView('panel.auth.login');

        Fortify::requestPasswordResetLinkView('panel.auth.forgot-pass');

        Fortify::resetPasswordView(function (Request $request) {
            return view('panel.auth.reset-pass', ['request' => $request]);
        });
    }

    protected function composeViews()
    {

    }
}
