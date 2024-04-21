<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\DB1;
use App\Models\DB2;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class Example2Test extends TestCase
{
    use DatabaseTransactions;

    protected array $connectionsToTransact = [ 'mysql', 'pgsql' ];

    public function test_normal(): void
    {
        DB1::factory()->count(3)->create();

        $this->assertDatabaseCount(DB1::class, 3);
    }

    public function test_parallel(): void
    {
        DB1::factory()->count(3)->create();

        $this->assertDatabaseCount(DB1::class, 3);

        DB2::factory()->count(3)->create();

        $this->assertDatabaseCount(DB2::class, 3);
    }
}
