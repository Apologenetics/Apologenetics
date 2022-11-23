<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserDatatable extends Component
{
    public ?array $users = null;

    public ?string $sortBy = null;

    public int $limit = 10;

    public function mount(array $userIds = [])
    {
        $with = [
            'faith',
            'faith.denomination',
            'faith.religion'
        ];

        if (empty($users) && ! empty($userIds)) {
            $this->users = User::query()
                ->with($with)
                ->whereIn('id', $userIds)
                ->take($this->limit)
                ->get()
                ->toArray();
        } else {
            $this->users ??= User::query()
                ->with($with)
                ->take($this->limit)
                ->get()
                ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.users.user-datatable');
    }
}
