<?php

namespace App\Providers;

use App\Models\Server;
use App\Models\ServerTranslation;
use App\Observers\ServerObserver;
use App\Services\ServerConfigurationService;
use App\Services\ServerMediaService;
use App\Services\ServerRessourceService;
use App\Services\ServerService;
use App\Services\ServerTranslationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les services dans le container.
     *
     * @return void
     */
    public function register()
    {
        // Enregistrer les services
        $this->app->singleton(ServerService::class, function ($app) {
            return new ServerService();
        });
        $this->app->singleton(ServerTranslationService::class, function ($app) {
            return new ServerTranslationService();
        });
        $this->app->singleton(ServerConfigurationService::class, function ($app) {
            return new ServerConfigurationService();
        });
        $this->app->singleton(ServerRessourceService::class, function ($app) {
            return new ServerRessourceService();
        });
        $this->app->singleton(ServerMediaService::class, function ($app) {
            return new ServerMediaService();
        });

    }

    /**
     * Bootstrap les services.
     *
     * @return void
     */
    public function boot()
    {
        Server::observe(ServerObserver::class);

        /*
        // Enregistrer les observers
        \App\Models\ServerNode::observe(\App\Observers\ServerNodeObserver::class);
        \App\Models\ServerConfiguration::observe(\App\Observers\ServerConfigurationObserver::class);
        \App\Models\ServerMedia::observe(\App\Observers\ServerMediaObserver::class);
        \App\Models\ServerTranslation::observe(\App\Observers\ServerTranslationObserver::class);
        */
    }
}
