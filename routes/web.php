<?php

use App\Http\Controllers\Server\Admin\ServerAdminConfigurationController;
use App\Http\Controllers\Server\Admin\ServerAdminMediaController;
use App\Http\Controllers\Server\Admin\ServerAdminRessourceController;
use App\Http\Controllers\Server\Admin\ServerAdminTranslationController;
use App\Http\Controllers\Server\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'servers',
    'as' => 'servers.',
], function() {
    Route::get('', [ServerController::class, 'list'])->name('list');
    Route::get('create', [ServerController::class, 'create'])->name('create');
    Route::post('store', [ServerController::class, 'store'])->name('store');
});


Route::group([
    'as' => 'game.servers.',
    'prefix' => 'game/{server}',
], function () {
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function() {
        Route::group([
            'prefix' => 'configurations',
            'as' => 'configurations.',
        ], function() {
            Route::get('/', [ServerAdminConfigurationController::class, 'list'])->name('list');
            Route::get('create', [ServerAdminConfigurationController::class, 'create'])->name('create');
            Route::post('store', [ServerAdminConfigurationController::class, 'store'])->name('store');
            Route::group([
                'prefix' => '{configuration}',
            ], function() {
                Route::get('edit', [ServerAdminConfigurationController::class, 'edit'])->name('edit');
                Route::put('update', [ServerAdminConfigurationController::class, 'update'])->name('update');
            });
        });

        Route::group([
            'prefix' => 'translations',
            'as' => 'translations.',
        ], function() {
            Route::get('/', [ServerAdminTranslationController::class, 'list'])->name('list');
            Route::get('create', [ServerAdminTranslationController::class, 'create'])->name('create');
            Route::post('store', [ServerAdminTranslationController::class, 'store'])->name('store');
            Route::group([
                'prefix' => '{translation}',
            ], function() {
                Route::get('edit', [ServerAdminTranslationController::class, 'edit'])->name('edit');
                Route::put('update', [ServerAdminTranslationController::class, 'update'])->name('update');
            });
        });


        Route::group([
            'prefix' => 'ressources',
            'as' => 'ressources.',
        ], function() {
            Route::get('/', [ServerAdminRessourceController::class, 'list'])->name('list');
            Route::get('create', [ServerAdminRessourceController::class, 'create'])->name('create');
            Route::post('store', [ServerAdminRessourceController::class, 'store'])->name('store');
            Route::group([
                'prefix' => '{ressource}',
            ], function() {
                Route::get('edit', [ServerAdminRessourceController::class, 'edit'])->name('edit');
                Route::put('update', [ServerAdminRessourceController::class, 'update'])->name('update');
            });
        });

        
        Route::group([
            'prefix' => 'medias',
            'as' => 'medias.',
        ], function() {
            Route::get('/', [ServerAdminMediaController::class, 'list'])->name('list');
            Route::get('create', [ServerAdminMediaController::class, 'create'])->name('create');
            Route::post('store', [ServerAdminMediaController::class, 'store'])->name('store');
            Route::group([
                'prefix' => '{media}',
            ], function() {
                Route::get('edit', [ServerAdminMediaController::class, 'edit'])->name('edit');
                Route::put('update', [ServerAdminMediaController::class, 'update'])->name('update');
            });
        });

        Route::get('/', function() {
            return 'Admin';
        })->name('index');
    });

    Route::group([
        'prefix' => 'api',
        'as' => 'api.',
    ], function() {
        Route::get('/', function() {
            return 'API';
        })->name('index');
    });

    Route::group([
        'prefix' => 'play',
        'as' => 'play.',
    ], function() {
        Route::get('/', function() {
            return 'Play';
        })->name('index');
    });
});