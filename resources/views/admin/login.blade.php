
@extends('layouts.blog_layout')

@section('content')
    <div class="container mt-4">

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <div class="card shadow">
                    <h5 class="card-header">Admin</h5>

                    <div class="card-body">
                        <form action="{{ route('login_post') }}" method="post">
                            @csrf

                            <input type="password" class="form-control mb-1 @if (session('password_status')) border border-danger border-2 @endif" id="password"  name="password" placeholder="heslo">

                           @if (session('password_status'))
                                <p class="text-danger m-0">
                                    {{session('password_status')}}
                                </p>
                           @endif

                           

                            <button class="btn btn-primary float-end mt-1" type = "submit">Login</button>
                        </form>
                    </div>
                </div>

                </div>
                <div class="col-md-4"></div>
            </div>
        
        
                       
    </div>
@endsection