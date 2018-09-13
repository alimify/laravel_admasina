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



                            <h3 class="title text-center"><b>Privacy</b></h3>

                            {!! html_entity_decode(Config::get('system.setting.privacy')) !!}

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
