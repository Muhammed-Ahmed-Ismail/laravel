@extends('layouts.app')
@section('title') Index @endsection
@section('content')

    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
      @foreach($posts as $post)
          @if(!$post->trashed())
            <tr>
                <td>
                {{ $post['id'] }}</th>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post['created_at']->format('Y-m-d') }}</td>

                <td>
                    <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post'=>$post['id']]) }}" class="btn btn-primary">Edit</a>
                    <a type="button" class="btn btn-danger"  href="{{route('posts.confirmDelete',['id'=>$post['id']])}}">
                        Delete
                    </a>
                </td>
            </tr>
          @else
              <tr>

                  <td colspan="4" style="text-align: center">--</td>
                  <td>
                      <form action="{{ route('posts.retrieve',['id'=>$post['id']]) }}" method="post">
                          @csrf
                          @method('put')
                      <input type="submit" class="btn btn-warning" value="rollback">
                      </form>
                  </td>
              </tr>
          @endif

        @endforeach

        </tbody>
    </table>
    <div>
        {{$posts->links()}}
    </div>



@endsection

