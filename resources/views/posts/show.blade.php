@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">{{$post['description']}}</p>
        </div>
    </div>


    <div class="card mt-5">
        <div class="card-header">
            photo
        </div>
        <div class="card-body">
            <img src="{{$photo}}" alt="photo">
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            {{$post['title']}}
        </div>
        <div class="card-body">
            <h5 class="card-title " style="display: inline">Name: </h5>
            <p class="card-text" style="display: inline">{{$post->user->name}}</p><br>
            <h5 class="card-title " style="display: inline">date: </h5>
            <p class="card-text" style="display: inline">{{$post['created_at']->format('Y-m-d- h:i:s a')}}</p> <br>
            <h5 class="card-title " style="display: inline">Email: </h5>
            <p class="card-text" style="display: inline">{{$post->user->email}}</p><br>

        </div>

    </div>

    <form method="post" action="{{ route('comments.create')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">add comment</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">comment creator</label>
            <select class="form-control" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" value="{{$post['id']}}" name="postid">
        <input type="submit" class="btn btn-success">
    </form>
    @foreach($comments as $comment)
        @if(!$comment->trashed())
        <div class="card mt-5">
            <div class="card-header" style="background-color:#a2d2ff ">
                <p> commented by: {{$comment->user['name']}}</p>
                <p> Time: {{$comment['created_at']}} </p>
            </div>
            <div class="card-body">
                <h5 class="card-title">comment</h5>
                <p class="card-text">{{$comment['comment']}}</p>
            </div>
            <div class="align-self-end d-flex p-2">
                <form action="{{route('comments.delete')}}" method="post" class="m-4">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="commentid" value="{{$comment['id']}}">
                    <input type="hidden" name="postid" value="{{$post['id']}}">
                    <button type="submit" class="btn btn-danger btn-lg"><i class="bi bi-trash"></i></button>
                </form>
                <form class="m-4">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-pencil-square"></i></button>
                </form>
            </div>
        </div>
        @else
            <div class="card mt-5">
                <div class="card-header" style="background-color: #e63946">
                    deleted comment
                </div>
                <div class="card-body">

                </div>
                <div class="align-self-end d-flex p-2">
                    <form action="{{route('comments.retrieve')}}" method="post" class="m-4">
                        @csrf
                        @method('put')
                        <input type="hidden" name="commentid" value="{{$comment['id']}}">
                        <input type="hidden" name="postid" value="{{$post['id']}}">
                        <button type="submit" class="btn btn-warning btn-lg"><i class="bi bi-arrow-counterclockwise"></i></button>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endsection
