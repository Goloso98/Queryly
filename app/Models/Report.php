<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user that reported
   */
  public function user() {
    return $this->belongsTo('App\Models\User');
  }

    /**
   * The reported post
   */
  public function post() {
    return $this->belongsTo('App\Models\Post');
  }

    /**
   * The reported comment
   */
  public function comment() {
    return $this->belongsTo('App\Models\Comment');
  }
}