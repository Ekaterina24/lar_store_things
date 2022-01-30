<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //    получить логин
    public function getUsername() {
        return $this->username;
    }

    public function things() {
        return $this->hasMany('App\Models\Thing', 'user_id');
    }

//    public function requestUser() {
//        return $this->hasMany('App\Models\Request', 'user_id');
//    }

//    устанавливаем отношение многие ко многим, мои друзья
    public function friendsOfMine() {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id'); //многие ко многим
    }

//    устанавливаем отношение многие ко многим, друг
    public function friendOf() {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

//    получить друзей
    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

//    запросы в друзья
    public function friendRequests() {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

//    запрос на ожидание друга
    public function friendRequestsPending() {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

//    есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user) {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

//    получил запрос о дружбе
    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

//    добавить друга
    public function addFriend(User $user) {
        $this->friendOf()->attach($user->id);
    }

    //    удалить из друзей друга
    public function deleteFriend(User $user) {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }


//    принять запрос на дружбу
    public function acceptFriendRequest(User $user) {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

//    пользователь уже в друзьях
    public function isFriendWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

}
