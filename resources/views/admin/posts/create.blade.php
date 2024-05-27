@extends('layouts.blog_layout')

@section('content')
<div class="container">
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
        <div class="card mt-3 ">
            <h3 class="card-header p-3">Vytvořit</h3>
            <div class="card-body p-4">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') border border-danger border-2 @enderror" name="title" value="{{ old('title') }}">
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

                        <label for="alt" class="form-label">Image alt</label>
                        <input class="form-control" type="text" name="alt" id="alt">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea name="content" id="" cols="30" rows="17" class="textarea_admin form-control @error('content') border border-danger border-2 @enderror">{{old('content')}}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                
            </div>

            <div class="card-footer">
                <div class="float-end p-2">
                    <a href="{{route('posts.index')}}" class="btn btn-secondary btn-lg">zpět</a>
                    <button class="btn btn-primary btn-lg">post</button>
                </div>
                
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/7ec57fiktc8cbe67790jw3o90ilsg7spg3t1rfq9lw7wubo8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{asset('js/tiny_mce.js')}}"></script> 



@endsection