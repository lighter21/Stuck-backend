<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'username',
        'first_name',
        'second_name',
        'last_name',
        'birth_date',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $with = ['receivedInvitations'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function receivedInvitations()
    {
        return $this->hasMany(Invitation::class, 'receiver_id');
    }

    public function sendInvitations()
    {
        return $this->hasMany(Invitation::class, 'sender_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy("created_at", "DESC");
    }

    public function relationships()
    {
        return $this->hasMany(Relationship::class, 'user_first_id')->orWhere("relationships.user_second_id", $this->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
