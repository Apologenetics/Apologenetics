<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Query\Builder;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'country_iso_code' => 'integer',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'datetime'
        ];
    }

    // Attributes

    public function name(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name']
        );
    }

    public function profileUrl(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => route('users.show', ['username' => $attributes['username']])
        );
    }

    public function faithTitle(): Attribute
    {
        return new Attribute(
            get: function ($value, $attributes) {
                if (! $this->relationLoaded('faith')) {
                    $this->load('faith');
                }

                $faith = $this->getRelation('faith');

                $faithTitle = $faith->religion->name;

                if (isset($faith->denomination->name)) {
                    $faithTitle .= ' (' . $faith->denomination->name . ')';
                }

                return $faithTitle;
            }
        );
    }

    // Scopes

    public function scopeByDoctrine($query, $id)
    {
        // FIXME: Need to update to include doctrinables, this will not work
        return $query->select('users.*')
            ->join('faiths', 'faiths.id', '=', 'users.faith_id')
            ->join('religions', 'religions.id', '=', 'faiths.religion_id')
            ->leftJoin('denominations', 'denominations.id', '=', 'faiths.denomination_id')
            ->join('doctrines as doctrine1', 'doctrine1.religion_id', '=', 'religions.id')
            ->leftJoin('doctrines as doctrine2', 'doctrine2.denomination_id', '=', 'denominations.id')
            ->where('doctrine1.id', $id)
            ->orWhere('doctrine2.id', $id)
            ->groupBy('users.id');
    }

    public function scopeFromFaith(Builder $query, Faith $faith)
    {
        return $query
            ->addSelect('users.*', 'faiths.id')
            ->from('faiths')
            ->join('users', 'users.id', '=', 'faiths.user_id')
            ->where('faiths.id', $faith->getKey());
    }

    public function scopeSearch($query, string $search)
    {
        return $query->where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('username', 'LIKE', '%' . $search . '%');
    }

    // Relationships

    public function faith(): HasOne
    {
        return $this->hasOne(Faith::class, 'id', 'faith_id');
    }

    public function allFaiths(): HasMany
    {
        return $this->hasMany(Faith::class, 'user_id', 'id');
    }

    public function scopedFaith(): HasOne
    {
        return $this->hasOne(Faith::class, 'id', 'scoped_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function updatedPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'updated_by');
    }

    public function updatedNuggets(): HasMany
    {
        return $this->hasMany(Nugget::class, 'updated_by');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function commentsWithReplies(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function following(): MorphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    // Inverse Relationships

    public function faithUser(): BelongsTo
    {
        return $this->belongsTo(Faith::class, 'id', 'user_id');
    }

    public function postUser(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id', 'created_by');
    }

    public function postUpdatedUser(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id', 'updated_by');
    }

    public function nuggetUser(): BelongsTo
    {
        return $this->belongsTo(Nugget::class, 'id', 'created_by');
    }

    public function nuggetUpdatedUser(): BelongsTo
    {
        return $this->belongsTo(Nugget::class, 'id', 'updated_by');
    }

    public function createdByDoctrine(): BelongsTo
    {
        return $this->belongsTo(self::class, 'id', 'created_by');
    }

    public function updatedByDoctrine(): BelongsTo
    {
        return $this->belongsTo(self::class, 'id', 'updated_by');
    }
}
