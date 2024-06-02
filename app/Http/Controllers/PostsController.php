<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\Author;
use Carbon\Carbon;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('comments')->orderBy('created','desc')->paginate(9);

        return view('admin.posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    	$authors = Author::all();

        return view('admin.posts.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:3072|required',
            'alt' => 'nullable',
            'author' => 'required'
        ]);

        $image_path = $request->file('image')->store('/public');

        $extension = explode('/', $image_path); //dostane poslední řetězec za / (jméno obrazku)
        $image_name = end($extension);

        $post = Post::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'created' => date('Y/m/d H:i:s'),
            'authors_id' => $request->author
            ]
        );

        Image::create([
            'name'=>$image_name,
            'path'=>$image_path,
            'post_id'=>$post -> id,
            'alt'=>$request -> alt
        ]
        );
        
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for updating a resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $comments = Post::findOrFail($id)->comments()->orderBy('created','desc')->paginate(6);
		$authors = Author::all();

        return view('admin.posts.edit',['post' => $post, 'comments'=>$comments, 'authors' => $authors]);
    }

    /**
     * Update a resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'author' => 'required'
        ]);

        $post = Post::find($id);
        $post_img_record = Post::find($id)->image;

        //updatujeme nahledový obrázek postu
        if($request-> image != null)
        {
            $post_img_path = $post_img_record->path;

            Storage::delete($post_img_path);
            $post_img_path->delete();

            $image_path = $request->file('image')->store('/public');
            $extension = explode('/', $image_path); //dostane poslední řetězec za /     ...(jméno obrazku)
            $image_name = end($extension);

            Image::create([
                'name'=>$image_name,
                'path'=>$image_path,
                'post_id'=>$post -> id
            ]
            );
        }

        $post->title = $request -> title;
        $post->content = $request -> content;
        $post->authors_id = $request -> author;
        $post -> save();

        Image::where('post_id', $id)->update(['alt'=>$request->alt]);

        return redirect()->route('posts.index');
    }
    
    public function destroy($id)
    {
        $postImg = DB::table('images')->join('posts','images.post_id', '=', 'posts.id')->where('images.post_id','=',$id)->first();
        $postImgName = $postImg->name;

        Storage::delete('public/'.$postImgName);

        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
