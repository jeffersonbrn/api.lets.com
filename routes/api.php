<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\UploadsController;

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);

    //packages
    Route::get('/packages', [PackagesController::class, 'listPackages']);
    Route::get('/packages/{id}/view', [PackagesController::class, 'viewPackage']);
    Route::post('/packages/create', [PackagesController::class, 'createPackage']);
    Route::put('/packages/{id}/update', [PackagesController::class, 'updatePackage']);
    Route::delete('/packages/{id}/delete', [PackagesController::class, 'deletePackage']);
    Route::put('/packages/{id}/updatePackagePosition', [PackagesController::class, 'updatePackagePosition']);
    Route::post('/packages/{id}/uploadFile', [UploadsController::class, 'uploadFile']);


    //positions

    Route::get('/positions', [PositionsController::class, 'listPositions']);
    Route::get('/positions/{id}/view', [PositionsController::class, 'viewPosition']);
    Route::post('/positions/create', [PositionsController::class, 'createPosition']);
    Route::put('/positions/{id}/update', [PositionsController::class, 'updatePosition']);
    Route::delete('/positions/{id}/delete', [PositionsController::class, 'deletePosition']);
});
