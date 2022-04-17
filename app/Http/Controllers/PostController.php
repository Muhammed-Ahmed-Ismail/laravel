<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{

    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00'],
            ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00'],
            ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00'],
        ];
        return view('posts.index',[
            'myposts'=>$posts
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
        $id=($id>3)?3:$id;
        $id=($id<1)?1:$id;
        $posts = [
            ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
            ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
            ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
        ];
        return view('posts.show',[
            'post'=>$posts[$id-1]
        ]);
    }
    public function edit($id)
    {
        $id=($id>3)?3:$id;
        $id=($id<1)?1:$id;
        $posts = [
            ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
            ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
            ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00','email'=>'muhammed@gmail.com'],
        ];
        return view('posts.edit',[
            'post'=>$posts[$id-1]
        ]);
    }
    public function store()
    {
       return "Post Sotred Successfuly";
    }
}
