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
    return $this->hasMany('App\Models\Star');
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
    return $this->hasMany('App\Models\Tag');
  }
}
