<?php

namespace App\Observers;

use App\Models\Server;
use App\Models\ServerRessource;
use App\Services\ServerBuildingService;
use App\Services\ServerService;
use App\Services\ServerTranslationService;

class ServerObserver
{
    protected $serverService;
    protected $serverBuildingService;
    protected $serverTranslationService;

    public function __construct(ServerService $serverService, ServerBuildingService $serverBuildingService, ServerTranslationService $serverTranslationService)
    {
        $this->serverService = $serverService;
        $this->serverBuildingService = $serverBuildingService;
        $this->serverTranslationService = $serverTranslationService;
    }

    public function created(Server $server)
    {
        $this->serverService->createServerMedia($server);
        // Créer les médias et traductions par défaut pour chaque serveur
        $this->serverService->createServerConfigurations($server);
        // $this->serverService->createServerMedia($server);
        $this->serverService->createServerTranslations($server);

        $this->serverService->createServerDefaultRessources($server);

        $this->createServerBuilding($server);
    }

    public function createServerBuilding(Server $server) {
        $townhall = $this->serverBuildingService->createBuilding($server, 'building_mairie_title', 'building_mairie_desc', 1, 30, 1);
        $this->serverTranslationService->createTranslation($server, 'building_mairie_title', 'Mairie', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_mairie_title', 'TownHall', 'en');
        $this->serverTranslationService->createTranslation($server, 'building_mairie_desc', 'La Mairie est votre bâtiment principal.', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_mairie_desc', 'The TownHall is your main building.', 'en');


        $stone = ServerRessource::where('server_id', $server->id)->where('trans_key', 'stone')->get()->first();
        $wood = ServerRessource::where('server_id', $server->id)->where('trans_key', 'wood')->get()->first();
        $iron = ServerRessource::where('server_id', $server->id)->where('trans_key', 'iron')->get()->first();

        $this->serverBuildingService->generateCostOfBuilding($townhall, $stone, 200, 1.3);
        $this->serverBuildingService->generateCostOfBuilding($townhall, $wood, 150, 1.35);
        $this->serverBuildingService->generateCostOfBuilding($townhall, $iron, 100, 1.33);

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
