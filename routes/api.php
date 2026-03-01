<?php

use App\Http\Controllers\Api\V2\BotController;
use App\Http\Controllers\Api\V2\CompanyController;
use App\Http\Controllers\Api\V2\GameController;
use App\Http\Controllers\Api\V2\GroupController;
use App\Http\Controllers\Api\V2\InfrastructureController;
use App\Http\Controllers\Api\V2\ReferenceController;
use App\Http\Controllers\Api\V2\SystemController;
use App\Http\Controllers\Api\V2\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v2')->name('v2.')->group(function (): void {
    // Infrastructure
    Route::get('infrastructure', [InfrastructureController::class, 'show'])->name('infrastructure.show');

    // User
    Route::get('user', [UserController::class, 'show'])->name('user.show');
    Route::get('user-levels', [UserController::class, 'levels'])->name('user.levels');

    // Reference lists
    Route::prefix('references')->name('references.')->group(function (): void {
        Route::get('regions', [ReferenceController::class, 'regions'])->name('regions');
        Route::get('languages', [ReferenceController::class, 'languages'])->name('languages');
        Route::get('genres', [ReferenceController::class, 'genres'])->name('genres');
        Route::get('families', [ReferenceController::class, 'families'])->name('families');
        Route::get('classifications', [ReferenceController::class, 'classifications'])->name('classifications');
        Route::get('rom-types', [ReferenceController::class, 'romTypes'])->name('rom-types');
        Route::get('support-types', [ReferenceController::class, 'supportTypes'])->name('support-types');
        Route::get('player-counts', [ReferenceController::class, 'playerCounts'])->name('player-counts');
    });

    // Systems
    Route::prefix('systems')->name('systems.')->group(function (): void {
        Route::get('/', [SystemController::class, 'index'])->name('index');
        Route::get('media-types', [SystemController::class, 'mediaTypes'])->name('media-types');
        Route::get('{id}/media', [SystemController::class, 'media'])->name('media');
        Route::get('{id}/video', [SystemController::class, 'video'])->name('video');
    });

    // Games
    Route::prefix('games')->name('games.')->group(function (): void {
        Route::get('search', [GameController::class, 'search'])->name('search');
        Route::get('{id}', [GameController::class, 'show'])->name('show');
        Route::get('{id}/media', [GameController::class, 'media'])->name('media');
        Route::get('{id}/video', [GameController::class, 'video'])->name('video');
        Route::get('{id}/manual', [GameController::class, 'manual'])->name('manual');
    });

    // Groups
    Route::get('groups/{id}/media', [GroupController::class, 'media'])->name('groups.media');

    // Companies
    Route::get('companies/{id}/media', [CompanyController::class, 'media'])->name('companies.media');

    // Bot
    Route::prefix('bot')->name('bot.')->group(function (): void {
        Route::post('ratings', [BotController::class, 'storeRating'])->name('ratings.store');
        Route::post('proposals', [BotController::class, 'storeProposal'])->name('proposals.store');
    });
});
