@extends('layouts.admin.app')

@section('title','Book/Category/Create')

@push('css')


@endpush


@section('content')
    <div class="bg-white">
        <form method="post" action="{{route('admin.bookCategory.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group col-sm-8">
                <label for="image" class="font-weight-bold">Image</label>
                <input type="file" class="form-control-file" name="image">
            </div>

            <div class="form-group col-sm-8">
                <a href="{{route('admin.bookCategory.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" value="ADD">
            </div>
            <br>

        </form>
    </div>


@endsection


@push('script')

@endpush
