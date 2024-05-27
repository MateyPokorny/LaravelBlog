<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    protected $fillable = [
        'title',
        'content',
        'image_id',
        'created',
        'authors_id'
    ];
    
}
