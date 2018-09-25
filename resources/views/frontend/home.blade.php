@extends('layouts.frontend.app')

@section('title',Config::get('websettings.homePageTitle'))

@push('css')

@endpush

@section('content')
<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
         data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
         data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

@foreach($books as $book)
            <div class="swiper-slide">
                <a class="slider-category" href="{{route('viewBook',$book->id)}}">
                    <div class="blog-image"><img src="{{asset('storage/book/'.$book->image)}}" alt="book image"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                    @php
                                     $title = $book->title->first()->title;
                                     $title = $title ? $title : $book->dTitle->first()->title;
                                    @endphp
                                    <h3><b>{{$title}}</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->
@endforeach


        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

</div>

<section class="blog-area section">
    <div class="container">

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
                                        $title = $book->title->first()->title;
                                        $title = $title ? $title : $book->dTitle->first()->title;
                                        @endphp

                                        <span class="title"><b>{{$title}}</b></span>

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
                        <h4 class="title"><b>Latest Article</b></h4>
                        <ul>
   @foreach($articles as $article)
                            <li>
                                @php
                                $title = $article->title->first()->title;
                                $title = $title ? $title : $article->dTitle->first()->title;
                                @endphp
                                <a href="{{route('viewArticle',$article->id)}}">{{$title}}</a>
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

@endpush

