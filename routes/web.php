<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('activate/{activationToken}', 'Auth\ActivationController@activate')->name('user.activate');
Route::get('resend/{activationToken}', 'Auth\ActivationController@resend')->name('user.activate.resend');

Route::post('/{user}', 'FormsController@store')->name('forms.store');

Route::group([
    'middleware' => [
        'auth',
    ],
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/download', 'FormsController@download')->name('forms.download');
});

