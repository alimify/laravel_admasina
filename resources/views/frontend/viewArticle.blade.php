@extends('layouts.frontend.app')

@php
$title = $article->title->first()->title??0;
$title = $title ? $title : $article->dTitle->first()->title;
$description = $article->description->first()->description??0;
$description = $description ? $description : $article->dDescription->first()->description;
@endphp

@section('title',$title)

@push('css')
    <style>
        .post-area .post-image {max-width: 620px}
    </style>
@endpush

@section('content')


    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="javascript:void(0)"><img src="{{asset('storage/profile/'.$article->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="javascript:void(0)"><b>{{$article->user->name}}</b></a>
                                    <h6 class="date">{{$article->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="javascript:void(0)"><b>{{$title}}</b></a></h3>
                            <div class="post-image"><img src="{{asset('storage/post/'.$article->image)}}" alt="{{$title}}"></div>
                            {!!html_entity_decode($description)!!}

                           <!-- <ul class="tags">
                                @//foreach($article->tags as $tag)
                                <li><a href="">{//{$tag->title}}</a></li>
                                    @//endforeach
                            </ul>-->
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <?php $comments = $article->comments; ?>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{$comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$article->views}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{route('viewArticle',$article->id)}}"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url={{route('viewArticle',$article->id)}}"><i class="ion-social-twitter"></i></a></li>
                                <!--<li><a href="#"><i class="ion-social-pinterest"></i></a></li>-->
                            </ul>
                        </div>



                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="tag-area">

                            <h4 class="title"><b>Category</b></h4>
                            <ul>
                                @foreach($article->categories as $category)
                                <li><a href="{{route('article',['type' => 'category','id' => $category->id])}}">{{$category->title}}</a></li>
                                    @endforeach
                            </ul>

                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>TAG</b></h4>
                            <ul>
                                @foreach($article->tags as $tag)
                                <li><a href="{{route('article',['type' => 'tag','id' => $tag->id])}}">{{$tag->title}}</a></li>
                                    @endforeach
                            </ul>

                        </div>

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
@foreach($articles as $rticle)
                <div class="col-md-3 col-sm-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <a href="{{route('viewArticle',$rticle->id)}}">
                                <div class="blog-image"><img src="{{asset('storage/post/'.$rticle->image)}}" alt="image"></div>


                                <div class="blog-info">

                                    @php
                                    $title = $rticle->title->first()->title??0;
                                    $title = $title ? $title : $rticle->dTitle->first()->title;
                                    @endphp

                                    <span class="title"><b>{{$title}}</b></span>

                                    <ul class="post-footer">
                                        <li><i class="ion-chatbubble"></i>{{$rticle->comments->count()}}</li>
                                        <li><i class="ion-eye"></i>{{$rticle->views}}</li>
                                    </ul>
                                </div><!-- blog-info -->
                            </a>
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-md-6 col-sm-12 -->
@endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @if(Auth::check())
                        <form method="post" action="{{route('user.makeComment',['type' => 'post','id' => $article->id])}}">
                            <div class="row">
                                @method('POST')
                                 @csrf
                                    <!--<div class="col-sm-6">
                                    <input type="text" aria-required="true" name="name" class="form-control"
                                           placeholder="Enter your name" aria-invalid="true" required >
                                </div><!-- col-sm-6 -->
                                <!--<div class="col-sm-6">
                                    <input type="email" aria-required="true" name="email" class="form-control"
                                           placeholder="Enter your email" aria-invalid="true" required>
                                </div><!-- col-sm-6 -->

                                <div class="col-sm-12">
									<textarea name="message" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                            @else
                            <div class="text-center text-warning font-weight-bold"><a href="{{route('login')}}">Login</a> or <a href="{{route('register')}}">register</a> to make comment.</div>
                        @endif
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$article->comments->count()}})</b></h4>
                    @if($article->comments->count())
                     <div id="comments-load" class="commnets-area"></div>
                    <a class="more-comment-btn" href="javascript:void(0)" id="more-comment-btn"><b>VIEW MORE COMMENTS</a>
                    @endif
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
@endsection


@push('script')
<script>

 $( document ).ready(function() {

     let page = 1,
         total = `{{$article->comments->count()}}`,
         URI = `/comments/post/{{$article->id}}`;


     $("#comments-load").load(URI)

     $("#more-comment-btn").click(function () {
         const limit = page*8;
         if(limit < total){
             page+=1
             $("#comments-load").load(`${URI}?page=${page}`)
         }
     })


 })
</script>
@endpush
