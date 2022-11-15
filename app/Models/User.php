<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
    public function posts() {
        return $this->hasMany('App\Models\Post');
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

    /**
     * The cards this user owns.
     */
    public function cards() {
      return $this->hasMany('App\Models\Card');
    }
}
