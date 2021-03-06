<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Builder;
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
        'avatar',
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['parsed_avatar_path', 'parsed_background_path', 'friends_count'];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy("created_at", "DESC");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function relationships()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->using(Friend::class)->withPivot(['status', 'confirmed_at']);
    }

    public function friends()
    {
        return $this->relationships()->wherePivot('status', StatusType::ACCEPTED);
    }

    public function receivedInvitations()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->using(Friend::class)->withPivot(['status', 'confirmed_at'])->where('status', StatusType::PENDING);
    }

    public function sendInvitations()
    {
        return $this->relationships()->where('status', StatusType::PENDING);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members', 'user_id', 'group_id')->using(GroupMember::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

//    SCOPES

    public function scopeSuggestedFriends(Builder $query, $user_id)
    {
//        Userzy, kt??rych aktualny user nie ma w znajomych ani nie wys??a?? im zaproszenia
        return $query->where('id', '!=', $user_id)->whereDoesntHave('relationships', function ($q) use ($user_id) {
            return $q->where('user_id', '!=', $user_id)->orWhere('friend_id', '!=', $user_id);
        });

    }

//    APPENDS

    public function getParsedAvatarPathAttribute()
    {
        return asset('storage/images/' . $this->avatar);
    }

    public function getParsedBackgroundPathAttribute()
    {
        return asset('storage/images/' . $this->background);
    }

    public function getFriendsCountAttribute()
    {
        return $this->friends()->count();
    }

}
