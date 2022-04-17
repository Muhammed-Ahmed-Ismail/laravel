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
            <h5 class="card-title " style="display: inline">Name:  </h5>
            <p class="card-text"  style="display: inline">{{$post->user->name}}</p><br>
            <h5 class="card-title " style="display: inline">date: </h5>
            <p class="card-text"  style="display: inline">{{$post['created_at']}}</p> <br>
            <h5 class="card-title " style="display: inline">Email: </h5>
            <p class="card-text"  style="display: inline">{{$post->user->email}}</p><br>
            </div>
    </div>
@endsection
