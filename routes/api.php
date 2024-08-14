<?php

use App\Http\Controllers\Api\AmoCRM\AuthController;
use App\Http\Controllers\Api\AmoCRM\Leads\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('amocrm')->as('amocrm.')->group(function () {
    Route::any('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get("/leads", LeadController::class)->name('leads');
        Route::get("/contacts")->name('contacts');
        Route::get("/tasks")->name('tasks');
        Route::get("/notes")->name('notes');
        Route::get("/users")->name('users');
        Route::get("/account")->name('account');
    });
});