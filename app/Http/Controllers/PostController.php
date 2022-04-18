<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {

        $posts=Post::withTrashed()->paginate(10);
        return view('posts.index',[
            'posts'=>$posts
        ]);
    }
    public function create()
    {
        $users=User::all();
        return view('posts.create',[
            'users'=>$users
        ]);
    }
    public function show($id)
    {
        $post=Post::find($id);
        $users=User::all();
        return view('posts.show',[
            'post'=>$post,
            'users'=>$users
        ]);
    }
    public function edit($id)
    {
       $post=Post::find($id);
       $users=User::all();
        return view('posts.edit',[
            'post'=>$post,
            'users'=>$users
        ]);
    }
    public function store()
    {
        $input=request()->all();

        Post::create([
            'title'=>$input['title'],
            'writer_id'=>$input['writer_id'],
            'description'=>$input['description']
        ]);
        return to_route('posts.index');
    }
    public function update()
    {
        $input=request()->all();
        $post=Post::find($input['post_id']);
        $post->title=$input['title'];
        $post->description=$input['description'];
        $post->writer_id=$input['writer_id'];
        $post->save();
        return to_route('posts.index');
    }
    public function confirmDelete($id)
    {
        return view('posts.confirmDelete',[
           'id'=>$id
        ]);
    }
    public function delete($id)
    {
        $post=Post::find($id);
        $post->delete();
        return to_route('posts.index');
    }
    public function retrieve($id)
    {

        $post=Post::withTrashed()
            ->where('id', $id)->first();
        $post->restore();
        $post->save();
        return to_route('posts.index');
    }

    public function addComment()
    {
        $input=request()->all();
       // dd($input);
        $postid=$input['postid'];
        Comment::create([
            'commentable_id'=>$input['postid'],
            'user_id'=>$input['user_id'],
            'comment'=>$input['comment'],
            ]);
       $post= Post::find($input['postid']);
       // return redirect("/posts/$postid");
        return to_route('posts.show',$post);
    }

}
