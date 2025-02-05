<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\LoginController;

Route::get('/', [MessageController::class, 'messages'])->name('home');

Route::group([
    'controller' => LoginController::class,
    'as' => 'auth.'
], function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/send-sms', fn() => redirect()->route('home'));
    Route::post('/send-sms', 'sendSms')->name('sms.send');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group([
    'controller' => MessageController::class,
    'prefix' => '/messages',
    'as' => 'messages.'
], function () {
    Route::get('/', fn() => redirect()->route('home'))->name('index');
    Route::post('/', 'store')->name('store');
    Route::post('/{message}/edit', 'update')->name('update');
    Route::post('/{message}/delete', 'destroy')->name('delete');
});

