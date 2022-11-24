<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserDatatable extends Component
{
    use WithPagination;

    public ?string $sortBy = null;

    public int $limit = 10;

    public int $offset = 0;

    public function render()
    {
        $with = [
            'faith',
            'faith.denomination',
            'faith.religion'
        ];

        $users = null;

        if (empty($users) && ! empty($userIds)) {
            $users = User::query()
                ->with($with)
                ->whereIn('id', $userIds)
                ->offset($this->offset)
                ->simplePaginate($this->limit);
        } else {
            $users ??= User::query()
                ->with($with)
                ->offset($this->offset)
                ->simplePaginate($this->limit);
        }

        return view('livewire.users.user-datatable', [
            'users' => $users
        ]);
    }
}
