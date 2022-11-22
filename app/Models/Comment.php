<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user this comment belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * The post this comment belongs to
   */
  public function post() {
    return $this->belongsTo('App\Models\Post');
  }
}
