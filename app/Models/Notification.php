<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
  use HasFactory;
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  protected $appends = ['new_content'];

  /**
   * The user this post belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User', 'userid', 'id');
  }

  public function getNewContentAttribute() {
    return DB::table('new_answers')->where("notificationid", $this->id)->first();
  }
}
