<?php

use Illuminate\Support\Facades\Route;
use alimehraei\LinkedInAllInOne\Http\Controllers\Auth\LinkedInTokenCheck;


Route::group([
    'middleware' => ['web']
], function () {
    Route::any('linkedin_oauth2callback/', [LinkedInTokenCheck::class, 'saveTokens'])->name('linkedin.save.tokens');

});

Route::group([
    'middleware' => config('linkedin-v2.middleware', ['web']),
    'domain' => config('linkedin-v2.domain', null),
    'prefix' => config('linkedin-v2.prefix'),
], function () {
    Route::prefix('linkedin')->group(function () {
        Route::get('/application/register', [LinkedInTokenCheck::class, 'applicationRegister'])->name('linkedin.application.register');
    });
});
