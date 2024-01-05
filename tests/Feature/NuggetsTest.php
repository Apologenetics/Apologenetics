<?php

namespace Tests\Feature;

use App\Livewire\Nuggets\Create;
use App\Models\Nugget;
use App\Models\Nuggetable;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class NuggetsTest extends TestCase
{
    /** @test */
    public function it_can_create_nuggets(): void
    {
        $user = User::factory()->state([
            'email_verified_at' => now()
        ])->create();

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('state', [])
            ->call('submit');

        $this->assertEquals(1, Nugget::all()->count());
        $this->assertEquals(1, Nuggetable::all()->count());
    }
}
