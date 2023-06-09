<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Domains\Auth\Http\Controllers\Frontend\Registry\RegistryController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Registry'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });
	
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('registry/view/{id}', [RegistryController::class, 'view'])
        ->name('registry.view')
        ->breadcrumbs(function( Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('Viewing advisory'), route('frontend.user.dashboard'));
        });

    Route::patch('registry/update/{id}', [RegistryController::class, 'update'])
        ->name('registry.update');

});
