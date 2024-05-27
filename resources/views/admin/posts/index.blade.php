
@extends('layouts.blog_layout')

@section('content')

   

    <div class="container mt-4">
        <table class="table text-center text-white"> 
            <thead>
                <tr class="h4 bg-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                </tr>      
            </thead>

            <tbody>
                @foreach($posts as $post)

                 <!-- Modal -->
                <div class="modal fade" id="deleteModal{{$post -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="modal-title" id="exampleModalLabel">Opravdu smazat?</h5>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('posts.destroy',$post -> id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>

                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($post -> created))}}</td>
                    <td>{{$post->comments->count()}}</td>
                    <td>
                         <a href="{{ route('posts.edit',$post -> id) }}" class="btn btn-primary btn-sm">edit</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$post -> id}}">
                            delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        
        <div class="row mt-3">
            <div class="col d-grid">
                <a href="{{route('posts.create')}}" class="btn btn-success btn-lg shadow">New post</a>
            </div>

            <div class="col d-grid">
                <a href="{{route('dashboard')}}" class="btn btn-secondary btn-lg shadow">Zpět</a>
            </div>
        </div>
        <div class="float-end mt-3">{!! $posts -> links() !!}</div>

    </div>
@endsection