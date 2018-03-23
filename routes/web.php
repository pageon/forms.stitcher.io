<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('activate/{activationToken}', 'Auth\ActivationController@activate')->name('user.activate');
Route::get('resend/{activationToken}', 'Auth\ActivationController@resend')->name('user.activate.resend');

Route::group([
    'middleware' => [
        'auth',
    ],
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/download', 'FormsController@download')->name('forms.download');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/settings', 'SettingsController@store')->name('settings.store');
});

$tries = config('app.throttle.tries');
$timeout = config('app.throttle.timeout');

Route::middleware([
    "throttle:{$tries},{$timeout}",
])->post('/{user}', 'FormsController@store')->name('forms.store');
