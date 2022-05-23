<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'title', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
