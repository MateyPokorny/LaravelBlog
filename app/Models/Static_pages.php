<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Static_pages extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $table = 'static_pages';


    protected $fillable = [

       'content'

    ];

}
