<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;



class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created','desc')->paginate(9);
        return view('home.index', ['posts' => $posts]);
    }

    public function detail($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->orderBy('created','desc')->paginate(3);
        $author = $post->authors->name;

        return view('home.detail', ['post' => $post, 'comments' => $comments, 'author' =>  $author]);
    }

}
