@extends('layouts.app')
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            confirm deletion
        </div>
        <div class="card-body">
            <form action="{{route('posts.delete',['id'=>$id])}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete">
                <input type="reset" class="btn btn-primary" value="Cancel" >
            </form>
        </div>
    </div>
@endsection
