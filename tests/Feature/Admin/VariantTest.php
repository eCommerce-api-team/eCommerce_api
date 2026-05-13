<?php

namespace Tests\Feature\Admin;

use App\Models\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\Traits\AdminCrudAssertions;
use Tests\Support\Traits\AdminCrudTestSuite;
use Tests\TestCase;

class VariantTest extends TestCase
{
    use AdminCrudAssertions;
    use AdminCrudTestSuite;
    use RefreshDatabase;

    protected function endpoint(): string
    {
        return '/api/admin/variants';
    }

    protected function modelFactory()
    {
        return Variant::class;
    }

    protected function storeValidData(): array
    {
        return [
            'name' => 'white',
        ];
    }

    protected function updateValidData(): array
    {
        return [
            'name' => 'black',
        ];
    }
}
