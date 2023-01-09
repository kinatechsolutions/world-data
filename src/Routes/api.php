<?php

use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function (){

    Route::get('world/{model}/{id}', );

});

Route::get('/sigma', [KTL\Sigma\Http\Controllers\SigmaController::class, 'index'])
    ->name('sigma');

Route::post('/sigma', [KTL\Sigma\Http\Controllers\SigmaController::class, 'refresh'])
    ->name('refresh');

Route::post('/sigma/query', [KTL\Sigma\Http\Controllers\SigmaBaseController::class, 'apiquery'])
    ->name('sigma.query');
