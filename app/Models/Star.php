<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user that liked
   */
  public function user() {
    return $this->belongsTo('App\Models\User');
  }

    /**
   * The liked post
   */
  public function post() {
    return $this->belongsTo('App\Models\Post');
  }
}