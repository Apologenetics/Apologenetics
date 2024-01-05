<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Religion;
use App\Livewire\Doctrines\Create;
use App\Models\Doctrinable;
use App\Models\Doctrine;

class DoctrinesTest extends TestCase
{
    /** @test */
    public function it_can_create_doctrines(): void
    {
        $user = User::factory()->state([
            'email_verified_at' => now()
        ])->create();

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('state', [
                'religion_id' => 0,
                'denomination_id' => 0,
                'created_by' => 1,
                'doctrineable_type' => Religion::class,
                'doctrineable_id' => 1,
                'title' => 'doctrine_1',
                'description' => 'description for doctrine_1'
            ])
            ->call('submit');

        $this->assertEquals(1, Doctrine::all()->count());
        $this->assertEquals(1, Doctrinable::all()->count());
    }
}
