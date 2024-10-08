<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Faith;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string'],
            'username' => ['required', 'string', 'max:32', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:1'],
            'password' => new Password(6),
            'start_of_faith' => ['date', 'required'],
            'religion_id' => ['integer', 'required'],
            'denomination_id' => ['integer', 'sometimes'],
            'note' => ['string', 'sometimes', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'username' => $input['username'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $faith = Faith::create([
            'religion_id' => $input['religion_id'],
            'denomination_id' => $input['denomination_id'] ?? null,
            'start_of_faith' => $input['start_of_faith'],
            'user_id' => $user->getKey(),
            'note' => $input['note'] ?? null,
        ]);
        $user->faith_id = $faith->getKey();
        $user->save();
        $user->setRelation('faith', $faith);
        return $user;
    }
}
