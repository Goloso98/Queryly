<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Post;
use App\Models\Badge;
use App\Models\Tag;
use App\Models\Role;
use App\Models\User_question;

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
        'name', 'email', 'password', 'username', 'birthday', 'isBlocked', 'isDeleted'
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
        return $this->hasMany('App\Models\Role', 'userid');
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
        return $this->belongsToMany(Tag::class, 'user_tags', 'userid', 'tagid');
    }

    /**
     * The stars this user has left
     */
    public function stars() {
        return $this->hasMany('App\Models\Star', 'userid');
    }

    /**
    * The badges this user has earned.
    */
    public function badges() {
        return $this->belongsToMany(Badge::class, 'user_badges', 'userid', 'badgeid');
    }

    /**
     * The questions this user follows
     */
    public function questions(){
        return $this->belongsToMany(Post::class, 'user_questions', 'userid', 'postid');
    }

    /**
     * The reports this user has made
     */
    public function reports(){
        return $this->hasMany('App\Models\Report', 'userid');
    }

    /**
     * If user is following the postid
     */
    public function isFollowingPost($postid) {
        return User_question::where('userid', $this->id)->where('postid', $postid)->get()->isNotEmpty();
    }

    /**
     * check whether user has that role
     */
    public function hasRole($role) {
        return Role::where('userid', $this->id)->where('userrole', $role)->get()->isNotEmpty();
    }

    /**
     * The notifications this user has.
     */
    public function notifications() {
        return $this->hasMany('App\Models\Notification', 'userid');
    }

    /**
     * count user unread notifications
     */
    public function unreadNotificationsCounter() {
        return $this->notifications()->where('isread', false)->count();
    }

}
