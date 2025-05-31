<?php

use App\Http\Controllers\MacAddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/mac-addresses/clear', [MacAddressController::class, 'clear'])
    ->name('mac-addresses.clear');
Route::resource('mac-addresses', MacAddressController::class);
