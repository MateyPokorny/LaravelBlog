@extends('layouts.blog_layout')

@section('content')

    <main class="center">
        <div class="container-fluid p-5 mt-1">
        
        <div class="mb-5 text-white text-center dark_c rounded-3 animate__animated animate__fadeInDown p-4" id="banner">

        </div>
        	<div class="animate__animated animate__zoomIn">
	            <div @if ($posts->count() >= 3)class="posts_grid" @else class="block_post_wrapper" @endif>
	                @foreach ($posts as $post)
	                    
	                        <a href="{{route('detail',$post->id)}}">
	                            <span class="js-tilt d-block" data-tilt>
	                                <article class="post" @if ($posts->count() < 3) style="margin-bottom: 40px"  @endif>
	                                    <div>
	                                        <img src="{{ asset('storage/'.$post->image->name) }}" @if($post->image->alt != null) alt="{{$post->image->alt}}" @endif style="width: 100%; height: 250px; object-fit:cover" >
	                                    </div>
	                                    <div class="gradient_div"></div>
	                                    <div class="post_date">
	                                        {{date('d.m.Y', strtotime($post -> created))}}
	                                    </div>
	                                    <div class="post_body text-white">
	                                        <h2 class="m-0">{{ $post->title }}</h2>
	                                    </div>
	                                </article>
	                            </span>
							</a>
	                @endforeach
				</div>
            </div>

            <div class="d-flex mt-4">
                <div class="mx-auto">
                    {!! $posts -> links() !!}
                </div>
            </div>
            
        </div>
    </main>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>

	<script>
		if ($(window).width() > 800) {
		   $('.js-tilt').tilt({
		   perspective: 2100,
		   speed: 500,
		})
		}
		else {
		   $('.js-tilt').tilt({
		   
		   maxTilt: 0,
		})
		}
		
	</script>
	
@endsection