<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class CommentsController extends Controller
{
    public function create_comment(Request $request, $post_id)
    {
        $this->validate($request,[
            'nickname'=>'required|max:50',
            'content'=>'required|max:500',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $comment=new Comment();
        $comment->fill(['nickname' => $request->nickname,'content'=>$request->content,'post_id'=>$post_id]);
        $comment->save();
        
        return redirect()->route('detail',$post_id.'#comments');
    }

    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);
        $post_id=$comment->post->id;
        $comment->delete();
        return redirect()->route('posts.edit',$post_id);
    }

    public function destroy_all($post_id)
    {
        DB::table('comments')->where('post_id', '=', $post_id)->delete();
        return redirect()->route('posts.edit',$post_id);
    }

    // endpoint pro nacitani dalsich komentaru pres AJAX
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
