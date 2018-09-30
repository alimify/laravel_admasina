@extends('layouts.frontend.app')

@section('title','Article')

@push('css')


@endpush


@section('content')


    <section class="blog-area section">
        <div class="container">
            <h4 class="title text-left"><b>Total Articles ({{$articles->count()}})</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @foreach($articles as $article)
                            <div class="col-md-4 col-sm-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <a href="{{route('viewArticle',$article->id)}}">
                                            <div class="blog-image"><img src="{{asset('storage/post/'.$article->image)}}" alt="image"></div>


                                            <div class="blog-info">
                                                @php
                                                $title = $article->title->first()->title??0;
                                                $title = $title ? $title : $article->dTitle->first()->title??'';
                                                @endphp

                                                <span class="title"><b>{{$title}}</b></span>

                                                <ul class="post-footer">
                                                    <li><i class="ion-chatbubble"></i>{{$article->comments->count()}}</li>
                                                    <li><i class="ion-eye"></i>{{$article->views}}</li>
                                                </ul>
                                            </div><!-- blog-info -->
                                        </a>
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-md-6 col-sm-12 -->
                        @endforeach




                    </div><!-- row -->

                    {{$articles->links()}}

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12">

                    <div class="single-post info-area ">


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
