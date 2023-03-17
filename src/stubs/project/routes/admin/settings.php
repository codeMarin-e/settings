<?php

use App\Http\Controllers\Admin\SettingsController;

Route::group([
    'controller' => SettingsController::class,
    'middleware' => ['auth:admin', 'can:settings_view'],
    'as' => 'settings.', //naming prefix
    'prefix' => 'settings', //for routes
], function() {
    Route::get('', 'index')->name('index');
    Route::patch('', 'update')->name('update')->middleware('can:settings_update');

    // @HOOK_ROUTES
});
