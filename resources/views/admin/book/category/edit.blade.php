@extends('layouts.admin.app')

@section('title','Book/Category/Edit')

@push('css')


@endpush


@section('content')


    <div class="bg-white">
        <form method="post" action="{{route('admin.bookCategory.update',$bookCategory->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Title</label>
                <input type="text" class="form-control" name="title" value="{{$bookCategory->title}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="image" class="font-weight-bold">Image</label>
                <div><img src="{{asset('storage/category/'.$bookCategory->image)}}" alt="" width="60"></div>
                <input type="file" class="form-control-file" name="image">
            </div>

            <div class="form-group col-sm-8">
                <a href="{{route('admin.bookCategory.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" value="EDIT">
            </div>
            <br>

        </form>
    </div>


@endsection


@push('script')

@endpush
