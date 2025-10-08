<?php

use App\Http\Controllers;
use App\Livewire\Religions\ShowReligion;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::get('/search', Controllers\SearchController::class)->name('search.results');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        /** @var User */
        $user = Auth::user();

        $user->following()->take(5);

        return view('dashboard', [
            'following' => $user->following,
        ]);
    })->name('dashboard');

    // Users
    Route::controller(Controllers\UserController::class)->group(function () {
        Route::get('/users', 'users')->name('users.index');
        Route::get('/users/edit/{user?}/{faith_id?}', 'edit')->name('users.edit');
        Route::get('/users/profile/{username?}', 'show')->name('users.show');
    });

    // Religion
    Route::controller(Controllers\ReligionController::class)->group(function () {
        Route::get('/religions', 'list')->name('religions.list');
        Route::get('/religions/create', 'create')->name('religions.create');
        Route::get('/religions/{religion}', ShowReligion::class)->name('religions.show');
        Route::get('/religions/{religion}/addNugget', 'addNugget')->name('religions.addNugget');
        Route::get('/religions/{religion}/denominations/create', 'createDenomination')->name('religions.create-denomination');
        Route::get('/religions/{religion}/denominations/edit/{denomination}', 'editDenomination')->name('religions.edit-denomination');
    });

    // Denomination
    Route::controller(Controllers\DenominationController::class)->group(function () {
        Route::get('/denominations/create', 'createDenomination')->name('denominations.create');
        Route::get('/denominations/{denomination}', 'show')->name('denominations.show');
    });

    // Doctrine
    Route::controller(Controllers\DoctrineController::class)->group(function () {
        Route::get('/doctrines', 'list')->name('doctrines.list');
        Route::get('/doctrines/create', 'create')->name('doctrines.create');
        Route::get('/doctrines/religions/{religion}', 'religions')->name('doctrines.religions');
        Route::get('/doctrines/denominations/{denomination}', 'denomination')->name('doctrines.denominations');
        Route::get('/doctrines/{doctrine}', 'show')->name('doctrines.show');
    });

    // Nuggets
    Route::controller(Controllers\NuggetController::class)->group(function () {
        Route::get('/nuggets', 'list')->name('nuggets.list');
        Route::get('/nuggets/religions/{religion}', 'religion')->name('nuggets.religion');
        Route::get('/nuggets/denominations/{denomination}', 'denomination')->name('nuggets.denomination');
        Route::get('/nuggets/doctrine/{doctrine}', 'doctrine')->name('nuggets.doctrine');
    });
});

require __DIR__ . '/auth.php';
