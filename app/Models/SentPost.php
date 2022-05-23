<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentPost extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'email'];
    protected $hidden = ['created_at', 'updated_at'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
