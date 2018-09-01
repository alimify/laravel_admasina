@extends('layouts.user.app')

@section('title',$user->name)

@push('css')


@endpush


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <form method="POST" action="{{route('user.profile.update',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="name">Quote</label>
                                <textarea name="quote" class="form-control" id="quote" aria-describedby="quoteHelp">{{$user->quote}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <img src="{{asset('storage/'.$user->image)}}" width="120px" alt="" class="d-block">
                                <input name="image" type="file" class="form-control form-control-file" id="image" aria-describedby="imageHelp">
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')

@endpush
