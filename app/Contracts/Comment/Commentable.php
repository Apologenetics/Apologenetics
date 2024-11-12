<?php

namespace App\Contracts\Comment;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Commentable
{
    public function modelType(): string;

    public function getId(): string;

    public function comments(): MorphMany;

    public function commentsWithReplies(): MorphMany;
}
