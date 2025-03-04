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

    private function createServerBuildingTownHall(Server $server) {
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

    private function createServerBuildingWoodcutter(Server $server) {
        $woodCutter = $this->serverBuildingService->createBuilding($server, 'building_woodcutter_title', 'building_woodcutter_desc', 1, 30, 1);
        $this->serverTranslationService->createTranslation($server, 'building_woodcutter_title', 'Scierie', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_woodcutter_title', 'WoodCutter', 'en');
        $this->serverTranslationService->createTranslation($server, 'building_woodcutter_desc', 'La Scierie produit votre bois.', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_woodcutter_desc', 'Woodcutter produce wood.', 'en');


        $stone = ServerRessource::where('server_id', $server->id)->where('trans_key', 'stone')->get()->first();
        $wood = ServerRessource::where('server_id', $server->id)->where('trans_key', 'wood')->get()->first();
        $iron = ServerRessource::where('server_id', $server->id)->where('trans_key', 'iron')->get()->first();

        //$this->serverBuildingService->generateProdOfBuilding($woodCutter, $stone, 200, 1.3);
        $this->serverBuildingService->generateProdOfBuilding($woodCutter, $wood, 60, 1.114);
        //$this->serverBuildingService->generateProdOfBuilding($townhall, $iron, 100, 1.33);

        $this->serverBuildingService->generateCostOfBuilding($woodCutter, $stone, 135, 1.237);
        $this->serverBuildingService->generateCostOfBuilding($woodCutter, $wood, 70, 1.20);
        $this->serverBuildingService->generateCostOfBuilding($woodCutter, $iron, 122, 1.261);
    }

    private function createServerBuildingIronMine(Server $server) {
        $ironMine = $this->serverBuildingService->createBuilding($server, 'building_ironmine_title', 'building_ironmine_desc', 1, 30, 1);
        $this->serverTranslationService->createTranslation($server, 'building_ironmine_title', 'Mine de fer', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_ironmine_title', 'Iron Mine', 'en');
        $this->serverTranslationService->createTranslation($server, 'building_ironmine_desc', 'La mine de fer produit votre fer.', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_ironmine_desc', 'Iron mine produce iron.', 'en');


        $stone = ServerRessource::where('server_id', $server->id)->where('trans_key', 'stone')->get()->first();
        $wood = ServerRessource::where('server_id', $server->id)->where('trans_key', 'wood')->get()->first();
        $iron = ServerRessource::where('server_id', $server->id)->where('trans_key', 'iron')->get()->first();

        $this->serverBuildingService->generateProdOfBuilding($ironMine, $iron, 60, 1.114);

        $this->serverBuildingService->generateCostOfBuilding($ironMine, $stone, 111, 1.237);
        $this->serverBuildingService->generateCostOfBuilding($ironMine, $wood, 103, 1.241);
        $this->serverBuildingService->generateCostOfBuilding($ironMine, $iron, 90, 1.231);
    }

    private function createServerBuildingStoneQuarry(Server $server) {
        $stoneQuarry = $this->serverBuildingService->createBuilding($server, 'building_stonequarry_title', 'building_stonequarry_desc', 1, 30, 1);
        $this->serverTranslationService->createTranslation($server, 'building_stonequarry_title', 'Carrière', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_stonequarry_title', 'Stone Quarry', 'en');
        $this->serverTranslationService->createTranslation($server, 'building_stonequarry_desc', 'La carrière produit votre pierre.', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_stonequarry_desc', 'The stone quarry produces stone.', 'en');

        $stone = ServerRessource::where('server_id', $server->id)->where('trans_key', 'stone')->get()->first();
        $wood = ServerRessource::where('server_id', $server->id)->where('trans_key', 'wood')->get()->first();
        $iron = ServerRessource::where('server_id', $server->id)->where('trans_key', 'iron')->get()->first();

        $this->serverBuildingService->generateProdOfBuilding($stoneQuarry, $stone, 50, 1.12);

        $this->serverBuildingService->generateCostOfBuilding($stoneQuarry, $stone, 100, 1.25);
        $this->serverBuildingService->generateCostOfBuilding($stoneQuarry, $wood, 80, 1.2);
        $this->serverBuildingService->generateCostOfBuilding($stoneQuarry, $iron, 90, 1.22);
    }

    private function createServerBuildingStorage(Server $server) {
        $storage = $this->serverBuildingService->createBuilding($server, 'building_storage_title', 'building_storage_desc', 1, 30, 1);
        $this->serverTranslationService->createTranslation($server, 'building_storage_title', 'Entrepôt', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_storage_title', 'Storage', 'en');
        $this->serverTranslationService->createTranslation($server, 'building_storage_desc', 'L\'entrepôt permet de stocker vos ressources.', 'fr');
        $this->serverTranslationService->createTranslation($server, 'building_storage_desc', 'The storage allows you to store your resources.', 'en');

        $stone = ServerRessource::where('server_id', $server->id)->where('trans_key', 'stone')->get()->first();
        $wood = ServerRessource::where('server_id', $server->id)->where('trans_key', 'wood')->get()->first();
        $iron = ServerRessource::where('server_id', $server->id)->where('trans_key', 'iron')->get()->first();

        $this->serverBuildingService->generateCostOfBuilding($storage, $stone, 120, 1.28);
        $this->serverBuildingService->generateCostOfBuilding($storage, $wood, 140, 1.3);
        $this->serverBuildingService->generateCostOfBuilding($storage, $iron, 110, 1.27);

        $this->serverBuildingService->generateStorageOfBuilding($storage, $stone, 500, 1.5);
        $this->serverBuildingService->generateStorageOfBuilding($storage, $wood, 500, 1.5);
        $this->serverBuildingService->generateStorageOfBuilding($storage, $iron, 500, 1.5);
    }


    public function createServerBuilding(Server $server) {
        $this->createServerBuildingTownHall($server);
        $this->createServerBuildingWoodcutter($server);
        $this->createServerBuildingIronMine($server);
        $this->createServerBuildingStoneQuarry($server);
        $this->createServerBuildingStorage($server);
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
