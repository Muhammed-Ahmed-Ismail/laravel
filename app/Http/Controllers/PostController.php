<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        /*$posts = [
            ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00'],
            ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00'],
            ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00'],
        ];*/
        $posts=Post::withTrashed()->paginate(10);
        //dd($posts);
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
        return view('posts.show',[
            'post'=>$post
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
        //dd($input);
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
        //dd($post);
        $post->restore();
        $post->save();
        return to_route('posts.index');
    }
}
