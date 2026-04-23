<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Console\Commands\CartsClearAbandoned;

class CartsClearAbandonedTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_carts_clear_abandoned(): void
    {
       $this->artisan('carts:clear-abandoned')->assertSuccessful()->expectsOutput('Carts cleared');
    }
}
