<?php

use Illuminate\Support\Facades\Route;
use Kinatech\World\Controllers\WorldDataController;


Route::prefix('api')->group(function (){
    Route::get('world/{model}/{model_id?}', [ WorldDataController::class, 'index']);
})->middleware(env('WORLD_ROUTE_MIDDLEWARE', null));
