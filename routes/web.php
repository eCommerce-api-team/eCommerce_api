<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-mail', function () {

    $user = (object)[
        'name' => 'Nada',
        'email' => 'test@test.com'
    ];

    Mail::to($user->email)->send(new WelcomeEmail($user));

    return 'Mail sent!';
});
