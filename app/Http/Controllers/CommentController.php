<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        $input=request()->all();
        $postid=$input['postid'];
        Comment::create([
            'commentable_id'=>$input['postid'],
            'user_id'=>$input['user_id'],
            'comment'=>$input['comment'],
        ]);
        $post= Post::find($input['postid']);
        return to_route('posts.show',$post);
    }
    public function delete()
    {
        $input=request()->all();
        $id=$input['commentid'];
        $postid=$input['postid'];
        $comment=Comment::find($id);
        $comment->delete();
        $post= Post::find($input['postid']);
        return to_route('posts.show',$post);
    }
    public function retrieve()
    {
        $input=request()->all();
        $postId=$input['postid'];
        $commentId=$input['commentid'];
        $comment=Comment::withTrashed()
            ->where('id', $commentId)->first();
        $post=Post::find($postId);
        $comment->restore();
        $comment->save();
        return to_route('posts.show',$post);
    }
}
