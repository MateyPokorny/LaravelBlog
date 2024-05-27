
@extends('layouts.blog_layout')

@section('content')
    <div class="container mt-4">

    <div class="d-grid gap-3">
        <a href="{{route('posts.index')}}" class="btn btn-primary" type="button">Posts</a>
        <a href="{{route('view_edit_about')}}" class="btn btn-primary" type="button">About page</a>
        <a class="btn btn-danger" href="{{ route('logout') }}">logout</a>

    </div>
        
                       
    </div>
@endsection