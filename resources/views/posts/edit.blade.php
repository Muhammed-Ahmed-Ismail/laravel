@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('posts.update',['id'=>$post->id])}}" enctype="multipart/form-data">
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
        <div class="card mt-5">
            <div class="card-header">
                photo
            </div>
            <div class="card-body">
                <img src="{{Storage::url($post->photo_path)}}" alt="photo" style="max-width:100% ">
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label " >Post Photo</label>

            <input type="file" class="form-control-file @error('photo') is-invalid @enderror " id="exampleFormControlFile1" name="photo"/>
            @error('photo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <select class="form-control @error('writer_id') is-invalid @enderror" name="writer_id">
                <option value="s">-----Choose a user------</option>
                @foreach($users as $user)
                    @if($post->writer_id === $user->id)

                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif

                @endforeach
            </select>
            @error('writer_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection
