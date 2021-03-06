@extends('layouts.frontend.app')

@section('title',$book->title)

@push('css')
    <link rel="stylesheet" href="{{asset('frontend/css/rating.css')}}">
    <style>
        .post-area .post-image {max-width: 260px}
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


                            <h3 class="title"><a href="javascript:void(0)"><b>{{$book->title}}</b></a></h3>
                            <div class="color-gray"><b>Posted: </b><span class="color-gray">{{$book->created_at->diffForHumans()}}</span></div>
                            <div class="post-image"><img alt="{{$book->title}}" width="80px" src="{{asset($book->image)}}"></div>

                           <b>Description:</b>{!! html_entity_decode($book->description) !!}
                             <div id="rating-area">
                                 @php $rating = round($book->rate()->avg('rate'),1,PHP_ROUND_HALF_UP) @endphp
                                 <div id="rateYo"></div>
                                 <b>Rating: </b> <span id="rating-text">{{$rating}}/5</span>
                               </div>

                           <div class="paras"><b>Author: </b> @foreach($book->authors as $author) {{$author->title}}, @endforeach </div>

                           <div class="parsa"><b>Translator: </b> @foreach($book->translators as $translator) {{$translator->title}}, @endforeach </div>

                           <div class="parsa"><b>Download Link : </b>  <br/> {!! html_entity_decode($book->book_link) !!}  </div>
                            </div>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li><a href="#"><i class="ion-chatbubble"></i>{{$book->comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$book->views}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{route('viewBook',$book->id)}}"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url={{route('viewBook',$book->id)}}"><i class="ion-social-twitter"></i></a></li>
                            </ul>
                        </div>

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">


                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORY</b></h4>
                            <ul>
                                @foreach($book->categories as $category)
                                <li><a href="{{route('book',['type' => 'category','id' => $category->id])}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>TAG</b></h4>
                            <ul>
                                @foreach($book->tags as $tag)
                                <li><a href="{{route('book',['type' => 'tag','id' => $tag->id])}}">{{$tag->title}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">

                @foreach($books as $wook)
                    <div class="col-md-3 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="{{route('viewBook',$wook->id)}}">
                                    <div class="blog-image"><img src="{{asset($wook->image)}}" alt="image"></div>


                                    <div class="blog-info">

                                        <span class="title"><b>{{str_limit($wook->title,20)}}</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>{{$wook->comments->count()}}</li>
                                            <li><i class="ion-eye"></i>{{$wook->views}}</li>
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
            <h4><b>COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @if(Auth::check())
                            <form method="post" action="{{route('user.makeComment',['type' => 'book','id' => $book->id])}}">
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

                    <h4><b>COMMENTS({{$book->comments->count()}})</b></h4>
                    @if($book->comments->count())
                        <div id="comments-load" class="commnets-area"></div>
                        <a class="more-comment-btn" href="javascript:void(0)" id="more-comment-btn"><b>VIEW MORE COMMENTS</a>
                    @endif

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection


@push('script')
    <script src="{{asset('frontend/js/rating.js')}}"></script>
    <script>

        $( document ).ready(function() {

            let page = 1,
                total = `{{$book->comments->count()}}`,
                URI = `/comments/book/{{$book->id}}`,
                currentRating = $(`#rating`).data('current-rating');



            $("#comments-load").load(URI)

            $("#more-comment-btn").click(function () {
                const limit = page*8;
                if(limit < total){
                    page+=1
                    $("#comments-load").load(`${URI}?page=${page}`)
                }
            })

            $("#rateYo").rateYo({
                rating: `{{$rating}}`,
                maxValue: 5,
                numStars: 5,
                fullStar: true,
                onSet: function (value, rateYoInstance) {
                    console.log(value)
                    $.ajax({url: "/rating/book/{{$book->id}}/"+value, success: function(result){
                            $("#rating-text").text(result+'/5')
                        }});
                }
            })

        })
    </script>
@endpush
