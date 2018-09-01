@extends('layouts.admin.app')

@section('title','Language/Create')

@push('css')


@endpush


@section('content')

    <div class="bg-white">
        <form method="post" action="{{route('admin.language.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Country</label>
                <input type="text" class="form-control" name="country">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Language</label>
                <input type="text" class="form-control" name="language">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Short Code</label>
                <input type="text" class="form-control" name="short_code">
            </div>

            <div class="form-group col-sm-8">
                <label for="image" class="font-weight-bold">Flag</label>
                <input type="file" class="form-control-file" name="image">
            </div>

            <div class="form-group col-sm-8">
                <a href="{{route('admin.language.index')}}" class="btn btn-primary btn-danger">BACK</a> <input class="btn btn-primary" type="submit" value="ADD">
            </div>
            <br>

        </form>
    </div>


@endsection


@push('script')

@endpush
