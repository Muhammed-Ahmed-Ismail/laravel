@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('posts.update')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" name="id" >PostNumber</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="post_id" value="{{$post['id']}}" readonly>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" name="title">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="title" value="{{$post['title']}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$post['description']}}</textarea>
        </div>

        <div class="mb-3">
            <select class="form-control" name="writer_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection
