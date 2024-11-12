<?php

namespace App\Traits;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVotableRelation
{
    public function votes(): MorphMany
    {
        return call_user_func([$this, 'morphMany'], Vote::class, 'votable');
    }

    public function modelType(): string
    {
        return $this::class;
    }

    public function getId(): string
    {
        return (string) call_user_func([$this, 'getKey']);
    }
}
