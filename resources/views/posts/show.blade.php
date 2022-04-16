@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            {{$post['title']}}
        </div>
        <div class="card-body">
            <h5 class="card-title " style="display: inline">Name:  </h5>
            <p class="card-text"  style="display: inline">{{$post['post_creator']}}</p><br>
            <h5 class="card-title " style="display: inline">date: </h5>
            <p class="card-text"  style="display: inline">{{$post['created_at']}}</p> <br>
            <h5 class="card-title " style="display: inline">Email: </h5>
            <p class="card-text"  style="display: inline">{{$post['email']}}</p><br>
            </div>
    </div>
@endsection
