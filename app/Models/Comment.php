<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable=[
     'nickname',
     'content',
     'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
