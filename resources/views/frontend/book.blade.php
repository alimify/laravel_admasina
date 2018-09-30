@extends('layouts.frontend.app')

@section('title','Book')

@push('css')


@endpush


@section('content')

    <section class="blog-area section">
        <div class="container">
            <h4 class="title text-left"><b>Total Books ({{$books->count()}})</b></h4>
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

                    {{$books->links()}}

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12">

                    <div class="single-post info-area ">

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


                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->



@endsection


@push('script')

@endpush
