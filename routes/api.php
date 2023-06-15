<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ExportController;


Route::group(['as' => 'api.'], function () {
    Route::get( '/export/{type}', [ ExportController::class, 'index' ] )->name( 'export' );
});