<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Post;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    //RELATIONSHIPS

    /**
     * The posts this user owns.
     */
    public function roles(){
        return $this->hasOne('App\Models\Role');
    }

    /**
     * The posts this user owns.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'userid');
    }



    /**
     * The comments this user owns.
     */
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * The tags this user follows.
     */
    public function tags() {
        return $this->hasMany('App\Models\Tag');
    }

    /**
     * The badges this user has earned.
     */
    public function badges() {
        return $this->hasMany('App\Models\Badge');
    }

//    /**
//     * The cards this user owns.
//     */
//     public function cards() {
//      return $this->hasMany('App\Models\Card');
//    }
}
