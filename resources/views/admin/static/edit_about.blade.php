@extends('layouts.blog_layout')

@section('content')

<div class="container-fluid">
    <form action="{{route('edit_about')}}" method="POST">
        @csrf
                   
        <div class="card mt-3">
            <h3 class="card-header p-3">About page</h3>
            <div class="card-body p-4">



                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea name="content" id="" cols="30" rows="25" class="textarea_admin form-control @error('content') border border-danger border-2 @enderror">{!! $page->content !!}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                
            </div>

            <div class="card-footer">
                <div class="float-end p-2">
                    <a href="{{route('dashboard')}}" class="btn btn-secondary btn-lg">zpět</a>
                    <button class="btn btn-primary btn-lg">edit</button>
                </div>
                
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.tiny.cloud/1/7ec57fiktc8cbe67790jw3o90ilsg7spg3t1rfq9lw7wubo8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{asset('js/tiny_mce.js')}}"></script> 


@endsection