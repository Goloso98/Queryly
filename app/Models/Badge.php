<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use App\Models\User_badge;

class Badge extends Model
{
  use Notifiable, HasFactory;
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

    /**
   * Badge in the relation
   */
  public function users() {
    return $this->belongsToMany(User::class, 'user_badges', 'userid', 'badgeid');
  }
}