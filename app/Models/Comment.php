<?php

namespace App\Models;

use App\Traits\HasComments;
use App\Traits\HasVotableRelation;
use App\Contracts\Comment\Commentable;
use App\Contracts\Vote\Votable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model implements Commentable, Votable
{
    use HasComments, HasVotableRelation;

    protected $guarded = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Helpers

    public function mapToCommentArray(): array
    {
        $replies = $this->relations['repliesWithEssentials'];

        if (isset($replies) && $replies->isNotEmpty()) {
            $arr = [];

            foreach ($replies as $reply) {
                $arr[$reply->getKey()] = $reply;
            }

            $replies = $arr;

            unset($arr);
        }

        return [
            'id' => $this->attributes['id'],
            'user_id' => $this->attributes['user_id'],
            'parent_id' => $this->attributes['parent_id'],
            'created_by' => $this->relations['createdBy']->username,
            'created_at' => $this->getAttribute('created_at')->diffForHumans(),
            'updated_at' => $this->getAttribute('updated_at')?->diffForHumans(),
            'content' => $this->attributes['content'],
            'votes' => $this->relations['votes'],
            'replies' => $replies,
        ];
    }

    // Relationships

    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('replies');
    }

    public function repliesWithEssentials(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->with(['repliesWithEssentials', 'votes', 'createdBy']);
    }

    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    // Inverse Relationships

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
