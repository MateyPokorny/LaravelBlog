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

    //displays about page
    public function about()
    {
        $about_page = DB::table('static_pages')->where('id','=',1)->first();    //assuming just 1 static page
        return view('home.about',['page' => $about_page->content]);
    }

    //endpoint for loading additional comments via AJAX
    public function load_more_comments(Request $request, $post_id)
    {
        $comment_count = $request->comment_count;
        $comments = Post::find($post_id)->comments()->orderBy('created','desc')->skip($comment_count)->limit(4)->get();

        $data='';
        foreach ($comments as $comment)
        {
            $data = $data .'<div class="p-3 mb-3 dark_c"><div class="h3 mb-4">'.$comment -> nickname.'<i class="bi bi-person m-2"></i></div><p class="m-0">'.$comment->content.'</p></div>';
        }

        return $data;
    }



}
