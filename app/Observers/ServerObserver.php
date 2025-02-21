<?php

namespace App\Observers;

use App\Models\Server;
use App\Services\ServerService;

class ServerObserver
{
    protected $serverService;

    public function __construct(ServerService $serverService)
    {
        $this->serverService = $serverService;
    }

    public function created(Server $server)
    {
        // Créer les médias et traductions par défaut pour chaque serveur
        $this->serverService->createServerConfigurations($server);
        // $this->serverService->createServerMedia($server);
        $this->serverService->createServerTranslations($server);

        $this->serverService->createServerDefaultRessources($server);
        
    }

    /**
     * Handle the Server "updated" event.
     */
    public function updated(Server $server): void
    {
        //
    }

    /**
     * Handle the Server "deleted" event.
     */
    public function deleted(Server $server): void
    {
        //
    }

    /**
     * Handle the Server "restored" event.
     */
    public function restored(Server $server): void
    {
        //
    }

    /**
     * Handle the Server "force deleted" event.
     */
    public function forceDeleted(Server $server): void
    {
        //
    }
}
