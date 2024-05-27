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
        $comments_to_delete = DB::table('comments')->where('post_id', '=', $post_id)->delete();
        return redirect()->route('posts.edit',$post_id);
    }


}
