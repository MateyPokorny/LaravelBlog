 <!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($is_detail)) <meta name="description" content="{{$post->title}}">	@endif
    <link rel = "stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel = "stylesheet" href="{{ asset('css/pallete.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" type="image/x-icon" href="/icons/icons8-m-16.ico">

</head>
<body >
    <nav class="navbar navbar-expand-lg sticky-top navbar_shadow" style="background-image: linear-gradient(to right,#ff8947, #d13182 , #af37d7, #4242e3);">
    <div class="container-fluid ">
        <a class="navbar-brand text-black" href="{{route('home')}}">Domů</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link text-black" href="{{route('about_page')}}">About</a>


            @if(auth()->user())
            <a href="{{route('dashboard')}}" class="nav-link btn btn-info">{{auth()->user()->name}}</a>
            @endif
        </div>
        </div>
    </div>
    </nav>

    @yield('content')

    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</body>
</html>