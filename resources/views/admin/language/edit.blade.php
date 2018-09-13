@extends('layouts.admin.app')

@section('title','Language/Edit')

@push('css')


@endpush


@section('content')

    <div class="bg-white">
        <form method="post" action="{{route('admin.language.update',$language->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Country</label>
                <input type="text" class="form-control" name="country" value="{{$language->country}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Language</label>
                <input type="text" class="form-control" name="language" value="{{$language->language}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="title" class="font-weight-bold">Short Code</label>
                <input type="text" class="form-control" name="short_code" value="{{$language->short_code}}">
            </div>

            <div class="form-group col-sm-8">
                <label for="image" class="font-weight-bold">Flag</label>
                <div><img src="{{asset('storage/language/'.$language->image)}}" alt="" width="32"></div>
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
