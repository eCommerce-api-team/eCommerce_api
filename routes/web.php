<?php

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-mail', function () {

    $user = (object) [
        'name' => 'Nada',
        'email' => 'test@test.com',
    ];

    Mail::to($user->email)->send(new WelcomeEmail($user));

    return 'Mail sent!';
});
