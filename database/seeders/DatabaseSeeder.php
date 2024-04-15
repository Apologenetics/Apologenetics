<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faith;
use App\Models\Religion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $religions = Religion::factory(7)->create();

        $users = User::factory(100)->create();

        foreach ($users as $user) {
            $faithNumber = 1;

            $faiths = Faith::factory($faithNumber)
                ->state(function (array $attr) use ($religions, $user) {
                    return [
                        'start_of_faith' => Carbon::now()->subYears(0, 10),
                        'end_of_faith' => ((bool) rand(0, 1)) ? Carbon::now()->subDays(rand(0, 365)) : null,
                        'religion_id' => $religions->random()->getKey(),
                        'user_id' => $user->getKey()
                    ];
                })
                ->make();

            $user->allFaiths()->saveMany($faiths);
            $user->faith_id = $faiths->first()->getKey();
            $user->save();
        }
    }
}
