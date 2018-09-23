@extends('layouts.frontend.app')

@section('title','CONTACT US')

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



                            <h3 class="title text-center"><b>CONTACT US</b></h3>
                            <form method="post" action="{{route('sendcontactus')}}" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input type="text" class="form-control" name="email" required>
                                </div>

                                <!--<div class="form-group">
                                    <label for="phone" class="font-weight-bold">Phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>-->

                                <div class="form-group">
                                    <label for="subject" class="font-weight-bold">Subject</label>
                                    <input type="text" class="form-control" name="subject">
                                </div>

                                <div class="form-group">
                                    <label for="message" class="font-weight-bold">Message</label>
                                    <textarea class="form-control" name="message"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="attachment" class="font-weight-bold">Attachment</label>
                                    <input type="file" class="form-control" name="file">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-success" name="submit" value="Send Message">
                                </div>

                            </form>
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
