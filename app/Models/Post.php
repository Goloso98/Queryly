<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  //RELATIONSHIPS

  /**
   * The user this post belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User', 'userid', 'id');
  }

   /**
   * The stars this post has
   */
  public function stars() {
      return $this->hasMany('App\Models\Star', 'postid');
  }

  /**
   * The comments this post has
   */
  public function comments() {
    return $this->hasMany('App\Models\Comment');
  }

  /**
   *  The tags attached to this post
   */
  public function tags() {
    return $this->belongsToMany(Tag::class, 'question_tags', 'postid', 'tagid');
  }

  /**
   * The reports this post has received
   */
  public function reports(){
    return $this->hasMany('App\Models\Report', 'postid');
  }

  /**
  * The users that follow this question
  */
  public function followers(){
    return $this->belongsToMany(User::class, 'user_questions', 'userid', 'postid');
  }
}
