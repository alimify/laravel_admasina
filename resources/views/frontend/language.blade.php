@extends('layouts.frontend.app')

@section('title','WebTitle')

@push('css')

@endpush

@section('content')


    <section class="post-area section">
        <div class="container">

            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">



                            <h3 class="title text-center"><b>Language</b></h3>
                             <h6>Select Your default language</h6>
                            <ul class="border border-dark">
                              @foreach($languages as $language)
                                  <li class="d-block"><a class="color-skyblue font-weight-bold" href="{{route('set_language',$language->id)}}">{{$language->language}}</a></li>
                                  @endforeach
                            </ul>

                        </div><!-- blog-post-inner -->




                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->
                <div class="col-2"></div>

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


@endsection


@push('script')

@endpush
