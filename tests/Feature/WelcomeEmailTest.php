<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class WelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_email_after_registration()
    {
        Mail::fake();

        $response = $this->postJson('api/register',[
            'name' => 'nadine',
            'email' => 'nadine@gmail.com',
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
         ]);
        
        $response->assertOk();

        Mail::assertQueued(WelcomeEmail::class);
    }

}
