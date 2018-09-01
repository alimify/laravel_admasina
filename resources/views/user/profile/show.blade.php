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
                        <div class="text-center">
                        <img class="img-avatar img-circle text-center" src="{{asset('storage/'.$user->image)}}" alt="{{$user->name}} Image" width="200px">
                            <span class="d-block">{{$user->quote}}</span>
                        </div>
                    <div class="view-details">
                        <span class="d-block border-bottom mb-2 pb-2"><b>Name : </b>{{$user->name}}</span>
                        <span class="d-block border-bottom mb-2 pb-2"><b>Email : </b>{{$user->email}}</span>
                        <span class="d-block border-bottom mb-2 pb-2"><b>Role : </b>{{$user->Role->title}}</span>
                        <span class="d-block border-bottom mb-2 pb-2"><b>Joined : </b> Since {{$user->created_at->format('M Y')}}</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')

@endpush
