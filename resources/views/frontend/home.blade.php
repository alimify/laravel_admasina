@extends('layouts.frontend.app')

@section('title',Config::get('websettings.homePageTitle'))

@push('css')
    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="owl-carousel owl-theme">
        @foreach($books as $book)
            <div class="item">
                <a class="slider-category" href="{{route('viewBook',$book->id)}}">
                    <div class="slider-image">
                    <img src="{{asset('storage/book/'.$book->image)}}" alt="book image">
                    </div>
                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                @php
                                    $title = $book->title->first()->title??0;
                                    $title = $title ? $title : $book->dTitle->first()->title??'';
                                @endphp
                                <h3><b>{{str_limit($title,20)}}</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->
        @endforeach
    </div>



<section class="blog-area section">
    <div class="container">
        <h4 class="title text-left"><b>Latest Books</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">
@foreach($books as $book)
                    <div class="col-md-4 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <a href="{{route('viewBook',$book->id)}}">
                                    <div class="blog-image"><img src="{{asset('storage/book/'.$book->image)}}" alt="image"></div>


                                    <div class="blog-info">
                                        @php
                                        $title = $book->title->first()->title??0;
                                        $title = $title ? $title : $book->dTitle->first()->title??'';
                                        @endphp

                                        <span class="title"><b>{{str_limit($title,20)}}</b></span>

                                        <ul class="post-footer">
                                            <li><i class="ion-chatbubble"></i>{{$book->comments->count()}}</li>
                                            <li><i class="ion-eye"></i>{{$book->views}}</li>
                                        </ul>
                                    </div><!-- blog-info -->
                                </a>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
@endforeach




                </div><!-- row -->

                <a class="load-more-btn" href="{{route('book')}}"><b>SEE MORE</b></a>

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12">

                <div class="single-post info-area ">

                    <div class="latest-post-area about-area">
                        <h4 class="title"><b>Latest Articles</b></h4>
                        <ul>
   @foreach($articles as $article)
                            <li>
                                @php
                                $title = $article->title->first()->title??0;
                                $title = $title ? $title : $article->dTitle->first()->title??'';
                                @endphp
                                <a href="{{route('viewArticle',$article->id)}}">{{str_limit($title,50)}}</a>
                                <span class="color-gray d-block">Posted : {{$article->created_at->diffForHumans()}}</span>
                            </li>
    @endforeach


                        </ul>
                    </div>

                    <!--<div class="subscribe-area">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form>
                                <input class="email-input" type="text" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i class="ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div>--><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>BOOK CATEGORIES</b></h4>
                        <ul>
     @foreach($bookCategories as $bookCategory)
                            <li><a href="{{route('book',['type' => 'category','id' => $bookCategory->id])}}">{{$bookCategory->title}}</a></li>
      @endforeach
                        </ul>

                    </div><!-- Tag-area -->

                    <div class="tag-area">

                        <div class="title"><b>ARTICLE CATEGORIES</b></div>
                        <ul>
      @foreach($postCategories as $postCategory)
                            <li><a href="{{route('article',['type' => 'category','id' => $postCategory->id])}}">{{$postCategory->title}}</a></li>
      @endforeach
                        </ul>

                    </div><!-- Tag-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->


@endsection


@push('script')
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:15,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        //center:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            550:{
             items:2,
             nav:false
            },
            750:{
                items:3,
                nav:false
            },
            950:{
                items:4,
                nav:false
            }
        }
    })
</script>
@endpush

