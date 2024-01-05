<?php

namespace Tests\Feature;

use App\Livewire\Religions\CreateDenominations;
use App\Models\Denomination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DenominationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_denominations(): void
    {
        $user = User::factory()->state([
            'email_verified_at' => now()
        ])->create();

        Livewire::actingAs($user)
            ->test(CreateDenominations::class)
            ->set('state', [
                'religion_id' => 0,
                'approved' => false,
                'parent_id' => null,
                'name' => 'denomination_1',
                'created_by' => 1
            ])
            ->call('submit');

        $this->assertEquals(1, Denomination::all()->count());
    }
}
