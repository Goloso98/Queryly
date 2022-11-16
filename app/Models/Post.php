<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps  = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
