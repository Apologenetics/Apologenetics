<?php

namespace Tests\Feature;

use App\Livewire\Religions\Create;
use App\Models\Religion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReligionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_new_religion(): void
    {
        Livewire::test(Create::class)
            ->set('state', [
                'name' => 'religion_1',
                'parent_id' => null,
                'description' => 'description 1',
                'approved' => true,
                'created_by' => 1
            ])
            ->call('submit');

        // assert values
        $this->assertEquals(1, Religion::all()->count());
    }

    /** @test */
    public function it_can_approve_pending_religion(): void
    {
        $this->markTestSkipped('TODO');
    }
}
