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

    <form method="post" action="{{ route('posts.addComment')}}">
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
    @foreach($post->comments as $commnet)
        <div class="card mt-5">
            <div class="card-header">
                commented_by: {{$commnet->user['name']}}
            </div>
            <div class="card-body">
                <h5 class="card-title">comment</h5>
                <p class="card-text">{{$commnet['comment']}}</p>
            </div>
            <div class="align-self-end">
                <button class="btn btn-primary"><i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
            </div>
        </div>
    @endforeach
@endsection
