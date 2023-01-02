<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  use HasFactory;
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user this post belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User', 'userid', 'id');
  }
}
