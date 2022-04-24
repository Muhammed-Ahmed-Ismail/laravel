<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $comments=Comment::withTrashed()->where('commentable_id',$id)->get();


        return view('posts.show',[
            'post'=>$post,
            'users'=>$users,
            'comments'=>$comments,
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
    public function store(CreatePostRequest $request)
    {
        $input=$request->validated();

        $photoPath=$request->file('photo')->store('public/photos');

        Post::create([
            'title'=>$input['title'],
            'writer_id'=>$input['writer_id'],
            'description'=>$input['description'],
            'photo_path'=>$photoPath
        ]);
        return to_route('posts.index');
    }
    public function update(UpdatePostRequest $request)
    {
        $input=$request->validated();
        $post=Post::find($request->route()->id);
        if($request->hasFile('photo')){
           File::delete(public_path( Storage::url($post->photo_path)));

        }

        $post->title=$input['title'];
        $post->description=$input['description'];
        $post->writer_id=$input['writer_id'];
        $post->slug=Str::slug($input['title']);
        $post->photo_path=$request->file('photo')->store('public/photos');
        $post->save();
         return redirect()->back();
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

    public function viewAjax(Request $request): JsonResponse
    {
       $postId=$request->input('id');
       $post=Post::find($postId);
       $responseComments=array();
       foreach ($post->comments as $comment)
       {
            $responseComments[$comment->user->name]=$comment->comment;
       }
        return response()->json([
            'title'=>$post->title,
            'post'=>$post->description,
            'comments'=>$responseComments
        ]);
    }
    public function pruneOldPosts()
    {
        $proneJob=new PruneOldPostsJob();
        dispatch($proneJob);
        return to_route('posts.index');
    }


}
