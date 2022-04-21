@extends('layouts.app')
@section('title')
    Index
@endsection
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
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post['created_at']->format('Y-m-d') }}</td>

                    <td>
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('posts.edit', ['post'=>$post['id']]) }}" class="btn btn-primary">Edit</a>
                        <a type="button" class="btn btn-danger"
                           href="{{route('posts.confirmDelete',['id'=>$post['id']])}}">
                            Delete
                        </a>
                        <a type="button" class="btn btn-danger" id="{{$post['id']}}" onclick="sendAjax(event)"> view with ajax  </a>
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
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script  src="{{ url('/js/ajax.js') }}">

</script>
@endsection

