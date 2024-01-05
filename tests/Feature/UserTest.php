<?php

namespace Tests\Feature;

use \App\Models\User;
use \Illuminate\Foundation\Testing\RefreshDatabase;
use \Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_users()
    {
        $response = $this->post('/register', [
            'first_name' => 'Dominic',
            'last_name' => 'Sears',
            'username' => 'dominicsears',
            'email' => 'dominic@test.com',
            'gender' => 'M',
            'password' => 'password',
            'password_confirmation' => 'password',
            'religion_id' => 1,
            'denomination_id' => 1,
            'start_of_faith' => '2016-12-18',
        ]);

        $this->assertSame(1, User::all()->count());
        $response->assertRedirectToRoute('dashboard');
    }
}
