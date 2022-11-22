<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user that has a role
   */
  public function user() {
    return $this->belongsTo('App\Models\User');
  }

    /**
   * The role
   */
}