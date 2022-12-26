<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use App\Models\User_tag;
use App\Models\User;
use App\Models\Post;

class Tag extends Model
{
  use Notifiable, HasFactory;
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

    /**
   * User in the relation
   */
  public function users() {
    return $this->belongsToMany(User::class, 'user_tags', 'userid', 'tagid');
  }

    /**
   * Post in the relation
   */
  public function posts() {
    return $this->belongsToMany(Post::class, 'question_tags', 'postid', 'tagid');
  }
}