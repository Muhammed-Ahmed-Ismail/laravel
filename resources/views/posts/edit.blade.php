@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('posts.update',['id'=>$post->id])}}">
        @csrf


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" name="title">Title</label>
            <input type="text" class="form-control  @error('title') is-invalid @enderror " id="exampleFormControlInput1" placeholder="" name="title" value="{{$post['title']}}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="description">{{$post['description']}}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <select class="form-control @error('writer_id') is-invalid @enderror" name="writer_id">
                <option value="s">-----Choose a user------</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @error('writer_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection
