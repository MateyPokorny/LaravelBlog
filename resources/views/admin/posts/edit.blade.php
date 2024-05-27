@extends('layouts.blog_layout')

@section('content')
 <!-- Modal -->
    <div class="modal fade" id="delete_all_comments_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Opravdu smazat všechny komentáře?</h5>
                </div>
            
                <div class="modal-footer">
                    <a href="{{route('delete_all_comments', $post->id)}}" class="btn btn-danger">smazat</a>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
                   
        <div class="card mt-3">
            <h3 class="card-header p-3">Upravit</h3>
            <div class="card-body p-4">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') border border-danger border-2 @enderror" name="title" value="{{$post->title}}">
                    @error('title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                	<label for="author" class="form-label">Autor</label>
                	<select class="form-select @error('author') border border-danger border-2 @enderror" name="author">
					  @foreach($authors as $author)
							<option value="{{$author -> id}}">{{$author -> name}}</option>
					  @endforeach
					</select>
                </div>

                <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input class="form-control @error('image') border border-danger border-2 @enderror" type="file" name="image" placeholder="Choose image" id="image">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alt" class="form-label">Image alt</label>
                    <input class="form-control" type="text" name="alt" id="alt" value="{{$post->image->alt}}">
                </div>
                

                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea name="content" id="" cols="30" rows="17" class="textarea_admin form-control @error('content') border border-danger border-2 @enderror">{!! $post->content !!}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                
            </div>

            <div class="card-footer">
                <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#delete_all_comments_modal">
                    delete all comments
                </button>

                <div class="float-end p-2">
                    <a href="{{route('posts.index')}}" class="btn btn-secondary btn-lg">zpět</a>
                    <button class="btn btn-primary btn-lg">edit</button>
                </div>
                
            </div>
        </div>
    </form>

    <div class="card mt-3">
        <div class="card-header">Komentáře</div>
        <div class="card-body">
        @if($comments->count()>0)

            <table class="table text-center"> 

                <thead>
                    <tr class="h4 bg-secondary">
                        <th scope="col">Created</th>
                        <th scope="col">Nick</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Delete</th>
                        
                    </tr>      
                </thead>

                <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{date('d-m-Y H:i:s', strtotime($comment -> created))}}</td>
                            <td>{{substr($comment->nickname,0,60);}}</td>
                            <td>{{substr($comment->content,0,60);}}</td>
                            <td>
                                <a href="{{ route('delete_comment',$comment -> id) }}" class="btn btn-danger btn-sm">delete</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>

            </table>

            <div class="d-flex mt-4">
                <div class="mx-auto">
                    {!! $comments -> links() !!}
                </div>
            </div>


        @else


        <p class="h5 text-muted text-center m-0">no comments</p>
        @endif
        </div>
    </div> 
</div>

<script src="https://cdn.tiny.cloud/1/7ec57fiktc8cbe67790jw3o90ilsg7spg3t1rfq9lw7wubo8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{asset('js/tiny_mce.js')}}"></script> 

@endsection