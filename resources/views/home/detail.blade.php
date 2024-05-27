@extends('layouts.blog_layout')

@section('content')

@php
    $is_detail = true;
@endphp
        
    <div class="mt-4">
        

        <div class="row m-2">
            <div class="col-lg-3"></div>
                <div class="col-lg-6 animate__animated animate__fadeIn">
                @error('g-recaptcha-response')
                    <div class="alert alert-danger text-danger" id="captcha_alert">
                        <div class="h4">
                            Komentář nebyl přidán
                            <span id="cancel_captcha_alert" style="cursor: pointer;" class='float-end'><i class="bi bi-x-lg"></i></span>

                        </div>

                        <p class='m-0'>nezaškrtli jste captchu!<i class="bi bi-robot"></i></p>

                    </div>
                @enderror

                    <main class="text-white">
                        <div>
                            <img src="{{ asset('storage/'.$post->image->name) }}" @if($post->image->alt != null) alt="{{$post->image->alt}}" @endif style="width: 100%; max-height: 350px; object-fit:cover">
                        </div>
                        
                        <div class="p-3 dark_c">

                            <div>
                                <h1 style="font-size:45px;" class="mb-3">
                                {{ $post->title }}
                                </h1>
                                
                                <div class="art-info-flex h5">
                                                                	
                                	<div class="art-info-item">                           		
                                		Napsal: <span style="text-shadow: 0px 0px 10px #26fffe; color: #26fffe;">{{ $author}}</span>    
                                	</div>
                                
                                	<div class="art-info-item" id="art-date" style="text-shadow: 0px 0px 10px #26fffe; color: #26fffe;">
                                		 <i class="bi bi-calendar "></i> {{date('d.m.Y', strtotime($post -> created))}}
                                	</div>

                                </div>
                                
                                
                            </div>
                            
                            <div class="gradient_div mt-3 mb-3"></div>
							<div class="p-3">
							   {!! $post->content !!}
							</div>
                        </div>                     
                    </main>

                    <div class="comment_box dark_c p-3 text-white mt-3 @error('content') border border-danger border-2 @enderror @error('nickname') border border-danger border-2 @enderror">

                        <div class="dark_c h2 text-center m-0 p-3" id="comment_banner" style="cursor: pointer;">
                        Přidat komentář<i class="bi bi-chat-left-text m-2"></i>
                        </div>

                        <form action="{{route('create_comment', $post->id)}}" method="POST" id="comment_form" class="">
                        @csrf

                            <div class="mb-3">
                                <label for="nickname" class="form-label mr-1">Přezdívka <i class="bi bi-person"></i></label><span class="text-secondary float-end">max. 50 znaků</span>
                                <input required maxlength="50" type="text" id="nickname" class="form-control @error('nickname') border border-danger border-2 @enderror" name="nickname" value="{{old('nickname')}}">
                                @error('nickname')  <p class="text-danger">{{$message}}</p> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Komentář <i class="bi bi-card-text"></i></label><span class="text-secondary float-end">max. 500 znaků</span>
                                <textarea required maxlength="500" name="content" id="content" class="form-control @error('content') border border-danger border-2 @enderror" cols="30" rows="7">{{old('content')}}</textarea>
                                @error('content')  <p class="text-danger">{{$message}}</p> @enderror

                            </div>

                            <div class="mb-3">
                                {!! NoCaptcha::renderJs('cz')!!}
                                {!! NoCaptcha::display() !!}

                            </div>
                            
                            <button class="btn btn-primary" type="submit">odeslat<i class="bi bi-check2"></i></button>
                            <span id="hide_comment_form" class="btn btn-outline-secondary float-end">schovat <i class="bi bi-arrow-bar-up"></i></span>
                            
                        </form>
                    </div>

                    <div class="mt-4 text-white pt-3" id="comments">
                        @foreach($comments as $comment)
                            <div class="p-3 mb-3 dark_c">
                                <div class="h3 mb-4">{{$comment -> nickname}}<i class="bi bi-person m-2"></i></div>
                                
                                <p class="m-0">{{$comment->content}}</p>
                            </div>
                        @endforeach
                        
                    </div>
                    @if($comments->count() == 3)
                    <div class="text-center mt-4">
                            <button id="load_more_btn" class="btn btn-info" onclick="getMoreComments()">zobrazit další</button>
                    </div>
                    @endif
                </div>
            <div class="col-lg-3"></div>
        </div>     
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    

$(document).ready(function(){

$("#hide_comment_form").click(function(){
$("#comment_form").slideUp("600");
});

$("#comment_banner").click(function(){
$("#comment_form").slideToggle('600');
});

$("#cancel_captcha_alert").click(function(){
    $("#captcha_alert").hide();
  });

});

function getMoreComments() {
    let comment_count = document.getElementById("comments").childElementCount;

    $.ajax({
    type:'GET',
    data:{ comment_count: comment_count },
    dataType:'html',
    url:"{{route('load_more_comments', $post->id)}}",
    success:function(data) {
        if(data == "")
        {

            $("#load_more_btn").attr('disabled', 'true');

            $("#load_more_btn").text("To je všechno");

        }

        $("#comments").append(data);

}});}
</script> 

@endsection